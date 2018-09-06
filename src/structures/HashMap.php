<?php
declare(strict_types=1);

namespace perf2k2\smartredis\structures;

use perf2k2\smartredis\Structure;

class HashMap extends Structure
{
    public function add(string $key, array $data): void
    {

    }

    public function get(string $key): array
    {
        return [];
    }

    public function contains(string $key, string $field = null): bool
    {
        return true;
    }
}