<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Debtor;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObject\Debtor\DebtorEmailStub;
use Tests\Stubs\Domain\ValueObject\Debtor\DebtorNameStub;
use Tests\Stubs\Domain\ValueObject\GovernmentIdStub;

class DebtorTest extends TestCase
{
    public function test_should_return_debtor_data_when_json_serialize(): void
    {
        $governmentId = GovernmentIdStub::random();

        $debtorEmail = DebtorEmailStub::random();

        $debtorName = DebtorNameStub::random();

        $debtor = new Debtor(
            name: $debtorName,
            governmentId: $governmentId,
            email: $debtorEmail,
        );

        $this->assertEquals(json_encode([
            Debtor::NAME => $debtorName->value,
            Debtor::GOVERNMENT_ID => $governmentId->value,
            Debtor::EMAIL => $debtorEmail->value,
        ]), json_encode($debtor));
    }
}