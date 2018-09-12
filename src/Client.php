<?php
declare(strict_types=1);

namespace perf2k2\smartredis;

use perf2k2\smartredis\structures\HashMapStructure;
use perf2k2\smartredis\structures\ListStructure;
use perf2k2\smartredis\structures\StringStructure;

class Client
{
    protected $conn;
    protected $structures = [];

    public function __construct(string $host, int $db, int $port = 6379, float $timeout = 0.0)
    {
        $this->conn = new \Redis();

        if (!$this->conn->connect($host, $port, $timeout) || !$this->conn->select($db)) {
            throw new Exception("Unable connect to Redis on {$host}:{$port}");
        }
    }

    public function getHashMap(string $name): HashMapStructure
    {
        return new HashMapStructure($this->conn, $name);
    }

    public function getString(string $name): StringStructure
    {
        return new StringStructure($this->conn, $name);
    }

    public function getList(string $name): ListStructure
    {
        return new ListStructure($this->conn, $name);
    }
}