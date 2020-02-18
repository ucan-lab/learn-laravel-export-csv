<?php declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Infrastructure\Port\Export;

final class FileUserCsvExport implements Export
{
    /**
     * @var string
     */
    private string $streamFilePath;

    /**
     * @var resource
     */
    private $handle;

    /**
     * @param string $header
     * @return void
     */
    public function prepare(string $header): void
    {
        $this->streamFilePath = $this->makeStreamFile();
        $this->handle = fopen($this->streamFilePath, 'wb+');
        $this->write($header);
    }

    /**
     * @param string $row
     * @return void
     */
    public function write(string $row): void
    {
        fwrite($this->handle, $row);
    }

    /**
     * @return void
     */
    public function disorganize(): void
    {
        fclose($this->handle);

        // 後処理 配置したい場所へコピーする等
        dump(file_get_contents($this->streamFilePath));

        unlink($this->streamFilePath);
    }

    /**
     * @return string
     */
    private function makeStreamFile(): string
    {
        return tempnam(sys_get_temp_dir(), config('app.name'));
    }
}
