<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCase\UserCsvExportUseCase;
use Illuminate\Console\Command;

class ExportUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'export user data.';

    /**
     * @var UserCsvExportUseCase
     */
    private UserCsvExportUseCase $useCase;

    /**
     * ExportUserCommand constructor.
     * @param UserCsvExportUseCase $useCase
     */
    public function __construct(UserCsvExportUseCase $useCase)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->useCase->handle();
    }
}
