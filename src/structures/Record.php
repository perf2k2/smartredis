<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Exception;
use perf2k2\smartredis\Structure;

class Record extends Structure
{
    public function set($value): void
    {
        if (!$this->conn->set($this->name, $value)) {
            throw new Exception("Unable to set value '{$value}' for key '{$this->name}'");
        }
    }

    /**
     * @return bool|string
     */
    public function getValue()
    {
        return $this->conn->get($this->name);
    }
}