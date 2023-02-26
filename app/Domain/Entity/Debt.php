<?php

namespace App\Domain\Entity;

use App\Domain\Collection\PaymentCollection;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Debt\DebtDueDate;
use App\Domain\ValueObject\Debt\DebtId;

class Debt implements \JsonSerializable
{
    public const DEBTOR = 'debtor';
    public const ID = 'id';
    public const AMOUNT = 'amount';
    public const DUE_DATE = 'due_date';
    public const PAYMENTS = 'payments';
    public const PENDING_AMOUNT = 'pending_amount';

    public function __construct(
        public readonly Debtor $debtor,
        public readonly DebtId $id,
        public readonly Currency $amount,
        public readonly DebtDueDate $dueDate,
        public readonly ?PaymentCollection $payments = null,
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
            self::PAYMENTS => $this->payments ?? [],
            self::PENDING_AMOUNT => $this->pendingAmount(),
        ];
    }

    public function pendingAmount(): Currency
    {
        if (!$this->payments) {
            return $this->amount;
        }

        $pendingAmount = $this->amount->value;

        foreach ($this->payments->getIterator() as $payment) {
            $pendingAmount -= $payment->amount->value;
        }

        if ($pendingAmount < 0) {
            return Currency::create(0);
        }

        return Currency::create($pendingAmount);
    }
}