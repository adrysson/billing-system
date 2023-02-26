<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Debt;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Payment\PaymentTime;
use App\Domain\ValueObject\Payment\PayerName;

class Payment implements \JsonSerializable
{
    public const PAY_DAY = 'pay_day';
    public const AMOUNT = 'amount';
    public const PAYER_NAME = 'payer_name';
    public const DEBT = 'debt';

    public function __construct(
        public readonly PaymentTime $paymentTime,
        public readonly Currency $amount,
        public readonly PayerName $payerName,
        public readonly ?Debt $debt = null,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            self::PAY_DAY => $this->paymentTime,
            self::AMOUNT => $this->amount,
            self::PAYER_NAME => $this->payerName,
            self::DEBT => $this->debt,
        ];
    }
}