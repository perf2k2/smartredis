<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Structure;

class HashMap extends Structure
{
    protected $conn;
    protected $name;

    public function __construct(Redis $conn, string $name)
    {
        $this->conn = $conn;
        $this->name = $name;
    }

    public function add(string $key, array $data): void
    {

    }

    public function update(string $key, string $field, $value): void
    {

    }

    public function get(string $key): array
    {
        return [];
    }

    public function getValue(string $key, string $field)
    {
        return null;
    }

    public function getAll(): array
    {
        return [];
    }

    public function contains(string $key, string $field = null): bool
    {
        return true;
    }
}