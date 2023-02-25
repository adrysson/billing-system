<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Debt\DebtAmount;
use App\Domain\ValueObject\Debt\DebtDueDate;
use App\Domain\ValueObject\Debt\DebtId;

class Debt implements \JsonSerializable
{
    public const DEBTOR = 'debtor';
    public const ID = 'id';
    public const AMOUNT = 'amount';
    public const DUE_DATE = 'due_date';

    public function __construct(
        public readonly Debtor $debtor,
        public readonly DebtId $id,
        public readonly DebtAmount $amount,
        public readonly DebtDueDate $dueDate,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::DEBTOR => $this->debtor,
            self::ID => $this->id,
            self::AMOUNT => $this->amount,
            self::DUE_DATE => $this->dueDate,
        ];
    }
}