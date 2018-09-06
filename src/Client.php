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

    }

    public function getHashMap(string $name): HashMap
    {
        return new HashMap($this->conn, $name);
    }
}