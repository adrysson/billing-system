<?php

namespace App\Domain\ValueObject\Payment;

class PaymentTime implements \JsonSerializable
{
    protected function __construct(
        public readonly string $value
    )
    {
    }

    public static function create(string $value): self
    {
        return new self(date('Y-m-d H:i:s', strtotime($value)));
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}