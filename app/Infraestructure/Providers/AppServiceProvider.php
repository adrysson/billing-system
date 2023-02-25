<?php

namespace App\Infraestructure\Providers;

use App\Domain\Adapter\DebtReceiver;
use App\Domain\Repository\FindDebtRepository;
use App\Domain\Repository\SaveDebtRepository;
use App\Infraestructure\Adapter\CsvDebtReceiver;
use App\Infraestructure\Repository\Eloquent\EloquentDebtRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DebtReceiver::class, CsvDebtReceiver::class);

        $this->app->bind(SaveDebtRepository::class, EloquentDebtRepository::class);
        $this->app->bind(FindDebtRepository::class, EloquentDebtRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
