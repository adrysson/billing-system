<?php

namespace App\Infraestructure\Repository\Log;

use App\Domain\Collection\DebtCollection;
use App\Domain\Enum\DebtsNotificationStatus;
use App\Domain\Repository\NotifyDebtsRepository;
use Illuminate\Support\Facades\Log;

class LogDebtRepository implements NotifyDebtsRepository
{
	public function notify(DebtCollection $debts): DebtsNotificationStatus
	{
		foreach ($debts->getIterator() as $debt) {
			Log::info(json_encode($debt));
		}

		return DebtsNotificationStatus::SUCCESS;
	}
}