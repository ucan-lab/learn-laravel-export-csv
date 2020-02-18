<?php declare(strict_types=1);

namespace App\Providers;

use App\Infrastructure\Adapter\DbUserRepository;
use App\Infrastructure\Adapter\FileUserCsvExport;
use App\UseCase\UserCsvExportUseCase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserCsvExportUseCase::class, function ($app) {
            return new UserCsvExportUseCase(new DbUserRepository(), new FileUserCsvExport());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
