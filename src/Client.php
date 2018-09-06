<?php
declare(strict_types=1);

namespace perf2k2\smartredis;

use perf2k2\smartredis\structures\HashMap;

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

    public function getHashMap(string $name): HashMap
    {
        return new HashMap($this->conn, $name);
    }
}