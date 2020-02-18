<?php declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Infrastructure\Port\Export;

final class InMemoryUserCsvExport implements Export
{
    /**
     * @var string
     */
    public string $file;

    /**
     * @param string $header
     */
    public function prepare(string $header): void
    {
        $this->file = $header;
    }

    /**
     * @param string $row
     */
    public function write(string $row): void
    {
        $this->file .= $row;
    }

    /**
     * @return void
     */
    public function disorganize(): void
    {
    }
}
