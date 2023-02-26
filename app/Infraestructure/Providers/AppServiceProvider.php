<?php

namespace App\Infraestructure\Providers;

use App\Domain\Adapter\DebtReceiver;
use App\Domain\Repository\FindDebtRepository;
use App\Domain\Repository\GetPendingDebtsRepository;
use App\Domain\Repository\NotifyDebtsRepository;
use App\Domain\Repository\SaveDebtRepository;
use App\Domain\Repository\SavePaymentRepository;
use App\Infraestructure\Adapter\CsvDebtReceiver;
use App\Infraestructure\Repository\Eloquent\EloquentDebtRepository;
use App\Infraestructure\Repository\Eloquent\EloquentPaymentRepository;
use App\Infraestructure\Repository\Log\LogDebtRepository;
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
        $this->app->bind(GetPendingDebtsRepository::class, EloquentDebtRepository::class);
        $this->app->bind(NotifyDebtsRepository::class, LogDebtRepository::class);
        $this->app->bind(SavePaymentRepository::class, EloquentPaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
