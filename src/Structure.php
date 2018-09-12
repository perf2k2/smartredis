<?php
declare(strict_types=1);

namespace perf2k2\smartredis;

abstract class Structure
{
    protected $conn;
    protected $name;

    public function __construct(\Redis $conn, string $name)
    {
        $this->conn = $conn;
        $this->name = $name;
    }

    public function isExists(): bool
    {
        return $this->conn->exists($this->name);
    }

    public function clear(): int
    {
        return $this->conn->del($this->name);
    }
}