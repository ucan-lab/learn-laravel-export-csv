<?php declare(strict_types=1);

namespace App\Infrastructure\Port;

use Generator;

interface UserRepository
{
    public function findAll(): Generator;
}
