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

    public function clear(): void
    {
        $this->conn->del($this->name);
    }
}