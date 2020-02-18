<?php declare(strict_types=1);

namespace App\UseCase;

use App\Domain\UserRow;
use App\Domain\UserRowHeader;
use App\Infrastructure\Port\Export;
use App\Infrastructure\Port\UserRepository;

final class UserCsvExportUseCase
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * @var Export
     */
    private Export $export;

    /**
     * @param UserRepository $repository
     * @param Export $export
     */
    public function __construct(UserRepository $repository, Export $export)
    {
        $this->repository = $repository;
        $this->export = $export;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->export->prepare(UserRowHeader::toCsv());

        /** @var UserRow $row */
        foreach ($this->repository->findAll() as $row) {
            $this->export->write($row->toCsv());
        }

        $this->export->disorganize();
    }
}
