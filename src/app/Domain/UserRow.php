<?php declare(strict_types=1);

namespace App\Domain;

use Carbon\Carbon;

final class UserRow
{
    private const EOF = "\n";
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    private string $name;
    private string $email;
    private Carbon $createdAt;
    private Carbon $updatedAt;

    public function __construct(
        string $name,
        string $email,
        Carbon $createdAt,
        Carbon $updatedAt
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function toCsv(): string
    {
        return implode(',', $this->toArray()) . self::EOF;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            $this->getName(),
            $this->email,
            $this->createdAt->format(self::DATE_FORMAT),
            $this->updatedAt->format(self::DATE_FORMAT),
        ];
    }

    /**
     * @return string
     */
    private function getName(): string
    {
        return strtoupper($this->name);
    }
}
