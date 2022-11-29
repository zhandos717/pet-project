<?php

namespace App\Core;

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
            $db = new PDO('sqlite:' . config('database.sqlite.path'));

            if (config('database.default') == 'mysql') {
                $db = new PDO(
                    'mysql:host=' . config('database.mysql.host') . ';dbname=' . config('database.mysql.database')
                    , config('database.mysql.username'), config('database.mysql.password')
                );
            }

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
    public function create(string $table, array $params)
    {
        $keys = array_keys($params);
        $fields = ':' . implode(',:', array_keys($params));
        $commaSeparated = implode(",", $keys);
        $sql = "INSERT INTO $table ($commaSeparated) VALUES ($fields)";
        $this->query($sql, $params);
        return $this->query("select * from $table order by id desc limit 1")->fetch();
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

    /**
     */
    private function checkTable(PDO $db): void
    {
        $count = $db->query("SELECT COUNT(*) as count FROM sqlite_master WHERE type='table'")->fetch()['count'];

        if ($count === 0 && config('app.migrations')) {
            $this->migrate($db);
        }
    }
}


