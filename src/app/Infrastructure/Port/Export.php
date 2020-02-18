<?php declare(strict_types=1);

namespace App\Infrastructure\Port;

interface Export
{
    public function prepare(string $header): void;
    public function write(string $row): void;
    public function disorganize(): void;
}
