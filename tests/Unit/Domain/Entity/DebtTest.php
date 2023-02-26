<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Debt;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtorStub;
use Tests\Stubs\Domain\ValueObject\CurrencyStub;
use Tests\Stubs\Domain\ValueObject\Debt\DebtDueDateStub;
use Tests\Stubs\Domain\ValueObject\Debt\DebtIdStub;

class DebtTest extends TestCase
{
    public function test_should_return_debt_data_when_json_serialize(): void
    {
        $debtor = DebtorStub::random();

        $debtId = DebtIdStub::random();

        $debtAmount = CurrencyStub::random();

        $debtDueDate = DebtDueDateStub::random();

        $debt = new Debt(
            debtor: $debtor,
            id: $debtId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
        );

        $this->assertEquals(json_encode([
            Debt::DEBTOR => $debtor->jsonSerialize(),
            Debt::ID => $debtId->value,
            Debt::AMOUNT => $debtAmount->value,
            Debt::DUE_DATE => $debtDueDate->value,
            Debt::PAYMENTS => [],
            Debt::PENDING_AMOUNT => $debt->pendingAmount(),
        ]), json_encode($debt));
    }
}