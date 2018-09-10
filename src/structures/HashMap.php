<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Exception;
use perf2k2\smartredis\Structure;

class HashMap extends Structure
{
    public function setAll(string $key, array $data): void
    {
        foreach ($data as $field => $value) {
            $this->set($key, $field, $value);
        }
    }

    public function set(string $key, string $field, $value): int
    {
        $result = $this->conn->hSet($this->getRedisKey($key), $field, $value);

        if ($result === false) {
            throw new Exception("Unable to set value '{$value}' for field '{$field}' at key '{$this->getRedisKey($key)}'");
        }

        return $result;
    }

    public function get(string $key): array
    {
        return $this->conn->hGetAll($this->getRedisKey($key));
    }

    /**
     * @param string $key
     * @param string $field
     * @param float|int $number
     * @return float
     * @throws Exception
     */
    public function increment(string $key, string $field, $number): float
    {
        if (is_float($number)) {
            return $this->conn->hIncrByFloat($this->getRedisKey($key), $field, $number);
        } elseif (is_int($number)) {
            return $this->conn->hIncrBy($this->getRedisKey($key), $field, $number);
        } else {
            throw new Exception("Number for increment field '{$field}' must be integer or float");
        }
    }

    /**
     * @param string $key
     * @param string $field
     * @return string|bool
     */
    public function getValue(string $key, string $field)
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