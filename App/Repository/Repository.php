<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\DB;
use Exception;
use ReflectionClass;
use ReflectionException;

class Repository
{
    /**
     * @var string
     */
    protected $table = '';

    /**
     * @var DB
     */
    protected DB $db;

    /**
     * @var array
     */
    protected array $casts = [];

    /**
     * @var string
     */
    protected string $where;

    /**
     * @var string
     */
    private string $select;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->db = new DB();

        $this->table = get_class_name($this) . 's';
    }

    public function select(array $colums = ['*']): self
    {
        $colums = implode(',', $colums);

        $this->select = "SELECT $colums  FROM $this->table ";
        return $this;
    }

    /**
     * @throws Exception
     */
    public function all(): array
    {
        return $this->db->query($this->select()->select)->fetchAll();
    }

    public function where( $column, $operator,  $value = null): self
    {

        $this->where = $value === null ? " $column = '$operator' " : " $column $operator '$value' ";

        return $this;
    }

    /**
     * @throws Exception
     */
    public function create(array $data): void
    {
        $this->db->create($this->table, $data);
    }

    /**
     * @throws Exception
     */
    public function get(?string $key = null)
    {
        $data = $this->db->query($this->getQueryBuilder())->fetchAll();

        return $data[0][$key] ?? $data;
    }

    protected function getQueryBuilder(): string
    {
        $sql = '';

        if (isset($this->select)) {
            $sql .= $this->select;
        }

        if (isset($this->where)) {
            $sql .= ' WHERE ' . $this->where;
        }
        return $sql;
    }

    /**
     * @throws Exception
     */
    protected function hasMany($class, array $params = ['*']): array
    {
        $class = app($class);

        $foreignKey = substr($this->table, 0, -1);

        return array_map(function ($item) use ($class, $foreignKey, $params) {
            return array_merge($item, [

                get_class_name($class) . 's' =>
                    $class
                        ->select($params)
                        ->where($foreignKey . '_id', $item['id'])
                        ->get()
            ]);
        }, $this->all());
    }
}