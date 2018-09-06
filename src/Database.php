<?php
declare(strict_types=1);

namespace perf2k2\smartredis;

use perf2k2\smartredis\structures\HashMap;

class Database
{
    protected $name;
    protected $structures;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStructure(string $name)
    {
        if (!array_key_exists($name, $this->structures)) {
            throw new Exception("Structure '{$name}' not found at the '{$this->name}' database");
        }

        return $this->structures[$name];
    }

    public function getHashMap(string $name): HashMap
    {
        return $this->getStructure($name);
    }
}