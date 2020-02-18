<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Infrastructure\Adapter\InMemoryUserCsvExport;
use App\Infrastructure\Adapter\InMemoryUserRepository;
use App\UseCase\UserCsvExportUseCase;
use Tests\TestCase;

final class UserCsvExportUseCaseTest extends TestCase
{
    /**
     * @param array $users
     * @param string $expectedCsv
     * @dataProvider dataResolve
     */
    public function testResolve(array $users, string $expectedCsv): void
    {
        $repository = new InMemoryUserRepository($users);
        $export = new InMemoryUserCsvExport();
        $useCase = new UserCsvExportUseCase($repository, $export);
        $useCase->handle();

        $this->assertEquals($expectedCsv, $export->file);
    }

    /**
     * @return array
     */
    public function dataResolve(): array
    {
        return [
            '正常3件' => $this->case正常3件(),
            '正常0件' => $this->case正常0件(),
        ];
    }

    /**
     * @return array
     */
    public function case正常3件(): array
    {
        $usersAttributes = [
            ['name' => 'yamada', 'email' => 'yamada@example.com', 'created_at' => '2020-01-01 00:00:00', 'updated_at' => '2020-01-01 00:00:00'],
            ['name' => 'suzuki', 'email' => 'suzuki@example.com', 'created_at' => '2020-01-01 00:00:00', 'updated_at' => '2020-01-01 00:00:00'],
            ['name' => 'tanaka', 'email' => 'tanaka@example.com', 'created_at' => '2020-01-01 00:00:00', 'updated_at' => '2020-01-01 00:00:00'],
        ];

        $expectedCsv = <<< EOT
        名前,メールアドレス,作成日,更新日
        YAMADA,yamada@example.com,2020-01-01 00:00:00,2020-01-01 00:00:00
        SUZUKI,suzuki@example.com,2020-01-01 00:00:00,2020-01-01 00:00:00
        TANAKA,tanaka@example.com,2020-01-01 00:00:00,2020-01-01 00:00:00

        EOT;

        return [
            $usersAttributes,
            $expectedCsv,
        ];
    }

    /**
     * @return array
     */
    public function case正常0件(): array
    {
        $usersAttributes = [];

        $expectedCsv = <<< EOT
        名前,メールアドレス,作成日,更新日

        EOT;

        return [
            $usersAttributes,
            $expectedCsv,
        ];
    }
}
