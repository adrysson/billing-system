<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Debt;
use App\Domain\ValueObject\Payment\PayDay;
use App\Domain\ValueObject\Payment\PayerName;
use App\Domain\ValueObject\Payment\PaymentAmount;

class Payment implements \JsonSerializable
{
    public const PAY_DAY = 'pay_day';
    public const AMOUNT = 'amount';
    public const PAYER_NAME = 'payer_name';
    public const DEBT = 'debt';

    public function __construct(
        public readonly PayDay $payDay,
        public readonly PaymentAmount $amount,
        public readonly PayerName $payerName,
        public readonly Debt $debt,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::PAY_DAY => $this->payDay,
            self::AMOUNT => $this->amount,
            self::PAYER_NAME => $this->payerName,
            self::DEBT => $this->debt,
        ];
    }
}