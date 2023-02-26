<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Debt;
use Tests\Stubs\Domain\ValueObject\CurrencyStub;
use Tests\Stubs\Domain\ValueObject\Debt\DebtDueDateStub;
use Tests\Stubs\Domain\ValueObject\Debt\DebtIdStub;

class DebtStub
{
    public static function random(): Debt
    {
        return new Debt(
            debtor: DebtorStub::random(),
            id: DebtIdStub::random(),
            amount: CurrencyStub::random(),
            dueDate: DebtDueDateStub::random(),
        );
    }
}