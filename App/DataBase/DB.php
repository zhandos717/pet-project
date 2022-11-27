<?php

namespace App\DataBase;

use App\Config;
use Exception;
use PDO;
use PDOStatement;

class DB
{
    /**
     * @throws Exception
     */
    public function connect(): PDO
    {
        try {
            $db = new PDO(config('database.default').':' . config('database.sqlite.path'));
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $this->checkTable($db);

            return $db;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function query(string $sql, ?array $params = []): bool|PDOStatement
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
            }
        }

        $stmt->execute();
        return $stmt;
    }


    /**
     * @throws Exception
     */
    public function create(string $table, array $params): bool|PDOStatement
    {
        $keys = array_keys($params);
        $fields = ':' . implode(',:', array_keys($params));
        $commaSeparated = implode(",", $keys);
        $sql = "INSERT INTO $table ($commaSeparated) VALUES ($fields)";
        return $this->query($sql, $params);
    }

    private function migrate(PDO $db): void
    {
        array_map(
        /**
         * @throws Exception
         */ function ($file) use ($db) {
            $migrationClass = Config::PATH_MIGRATIONS . $file;
            if (filetype($migrationClass) === 'file') {
                $db->exec((include $migrationClass)->up());
            }
        },
            scandir(Config::PATH_MIGRATIONS)
        );
    }

    private function checkTable(PDO $db): void
    {
        $count = $db->query("SELECT COUNT(*) as count FROM sqlite_master WHERE type='table'")->fetch()['count'];
        if ($count === 0) {
            $this->migrate($db);
        }
    }
}


