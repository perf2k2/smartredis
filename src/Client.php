<?php
declare(strict_types=1);

namespace perf2k2\smartredis;

class Client
{
    protected $conn;
    protected $dbs = [];

    public function __construct(string $host, int $port = 6379, float $timeout = 0.0)
    {

    }

    public function getDb(int $index): Database
    {
        if (!array_key_exists($index, $this->dbs)) {
            $this->dbs[$index] = new Database($index);
        }

        return $this->dbs[$index];
    }
}