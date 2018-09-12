<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Exception;
use perf2k2\smartredis\Structure;

class ListStructure extends Structure
{
    public function get(int $index): string
    {
        $result = $this->conn->lIndex($this->name, $index);

        if ($result === false) {
            throw new Exception("Unable to get value by index {$index} for list {$this->name}'");
        }

        return $result;
    }

    public function getAll(): array
    {
        return $this->conn->lrange($this->name, 0, -1);
    }
}