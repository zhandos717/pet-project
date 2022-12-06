<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\DB;
use App\Core\Request;
use Exception;
use ReflectionException;

class Repository
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var DB
     */
    protected DB $db;

    /**
     * @var array
     */
    protected array $casts = [];

    /**
     * @var string|null
     */
    protected ?string $where;

    /**
     * @var string
     */
    private string $select;
    /**
     * @var mixed|null
     */
    protected array $data;
    protected bool $find;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(Request $request)
    {
        $this->db = new DB();

        $id = $request->get(get_class_name($this));
        if (is_int($id)) {
            $this->find($id);
        }
    }


    /**
     * @throws ReflectionException
     */
    protected function getTableName(): string
    {
        return $this->table ?? get_class_name($this) . 's';
    }

    /**
     * @throws Exception
     */
    public function find(int $id): self
    {
        $this->find = true;

        $result = $this->select()->where('id', $id)->get();

        if (!$result) {
            throw new Exception(sprintf('Not found %s', get_class_name($this)), 404);
        }

        $this->data = $result;

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function select(array $colums = ['*']): self
    {
        $this->select = 'SELECT ' . implode(',', $colums) . '  FROM ' . $this->getTableName();
        return $this;
    }

    /**
     * @throws Exception
     */
    public function all(): array
    {
        return $this->db->query($this->select()->select)->fetchAll();
    }

    public function where($column, $operator, $value = null): self
    {
        $this->where = $value === null ? " $column = '$operator' " : " $column $operator '$value' ";
        return $this;
    }

    public function whereIn($column, array $value = null): self
    {
        $this->where = " $column IN ( " . implode(',', $value) . " ) ";
        return $this;
    }


    /**
     * @throws Exception
     */
    public function create(array $data): self
    {
        $this->data = $this->db->create($this->getTableName(), $data);

        return $this;
    }

    /**
     * @throws Exception
     */
    public function get(?string $key = null)
    {
        $data = $this->db->query($this->getQueryBuilder())->fetchAll();

        $this->where = null;
        return $data[0][$key] ?? $data;
    }

    /**
     * @throws ReflectionException
     */
    protected function getQueryBuilder(): string
    {
        $sql = '';

        if (!isset($this->select)) {
            $this->select();
        }

        $sql .= $this->select;

        if (isset($this->where)) {
            $sql .= ' WHERE ' . $this->where;
        }

        return $sql;
    }

    /**
     * @throws Exception
     */
    protected function hasMany($className, array $params = ['*']): array
    {
        /**
         * @var Repository $class
         */
        $class = app($className);

        $data = array_map(function ($item) use ($class, $params) {
            return array_merge($item, [
                $class->getTableName() =>
                    $class
                        ->select($params)
                        ->where(get_class_name($this) . '_id', $item['id'])
                        ->get()
            ]);
        }, $this->data);

        return $this->find ? array_shift($data) : $data;
    }


    /**
     * @throws Exception
     */
    public function delete(int $id): void
    {
        if (!$this->db->deleteById($this->getTableName(), $id)) {
            throw new Exception(sprintf('Not found %s', get_class_name($this)), 404);
        }
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function update(array $data, array $where): static
    {
        $this->data = $this->db->update($this->getTableName(), $data, $where);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {

        return app(self::class)->$name($arguments);
    }

    public function __invoke(): array
    {
        return isset($this->find) ? array_shift($this->data) : $this->data;
    }
}