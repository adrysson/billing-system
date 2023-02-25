<?php

namespace Tests\Stubs\Domain\Entity;

use App\Domain\Entity\Debtor;
use Tests\Stubs\Domain\ValueObject\Debtor\DebtorEmailStub;
use Tests\Stubs\Domain\ValueObject\Debtor\DebtorNameStub;
use Tests\Stubs\Domain\ValueObject\GovernmentIdStub;

class DebtorStub
{
    public static function random(): Debtor
    {
        return new Debtor(
            name: DebtorNameStub::random(),
            governmentId: GovernmentIdStub::random(),
            email: DebtorEmailStub::random(),
        );
    }
}