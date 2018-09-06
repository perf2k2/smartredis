<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Exception;
use perf2k2\smartredis\Structure;

class HashMap extends Structure
{
    protected $conn;
    protected $name;

    public function __construct(\Redis $conn, string $name)
    {
        $this->conn = $conn;
        $this->name = $name;
    }

    public function setAll(string $key, array $data): void
    {
        foreach ($data as $field => $value) {
            $this->set($key, $field, $value);
        }
    }

    public function set(string $key, string $field, $value): int
    {
        $result = $this->conn->hSet($this->getRedisKey($key), $field, $value);

        if (!$result) {
            throw new Exception("Unable to set value for {$this->getRedisKey($key)}");
        }

        return $result;
    }

    public function get(string $key): array
    {
        return $this->conn->hGetAll($this->getRedisKey($key));
    }

    public function getValue(string $key, string $field): string
    {
        return $this->conn->hGet($this->getRedisKey($key), $field);
    }

    public function contains(string $key, string $field = null): bool
    {
        if ($field === null) {
            return (bool)$this->conn->exists($this->getRedisKey($key));
        }

        return (bool)$this->conn->hExists($this->getRedisKey($key), $field);
    }

    protected function getRedisKey(string $key): string
    {
        return "{$this->name}:{$key}";
    }
}