<?php

namespace App\Presentation\Console\Commands;

use App\Application\NotifyDebts\DebtsNotifier;
use Illuminate\Console\Command;

class NotifyDebts extends Command
{
    protected $signature = 'debts:notify';

    protected $description = 'Collect payment of outstanding debts';

    public function __construct(private DebtsNotifier $debtsNotifier)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        ($this->debtsNotifier)();
    }
}
