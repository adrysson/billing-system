<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Debtor;
use App\Domain\ValueObject\Debtor\DebtorEmail;
use App\Domain\ValueObject\Debtor\DebtorName;
use App\Domain\ValueObject\GovernmentId;
use PHPUnit\Framework\TestCase;

class DebtorTest extends TestCase
{
    public function test_should_return_debtor_data_when_json_serialize(): void
    {
        $governmentIdValue = '12345678912';

        $governmentId = GovernmentId::create($governmentIdValue);

        $debtorEmailValue = 'john@email.com';

        $debtorEmail = DebtorEmail::create($debtorEmailValue);

        $debtorNameValue = 'John';

        $debtorName = DebtorName::create($debtorNameValue);

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