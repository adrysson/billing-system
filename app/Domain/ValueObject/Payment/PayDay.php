<?php

namespace App\Domain\ValueObject\Payment;

class PayDay implements \JsonSerializable
{
    protected function __construct(
        public readonly string $value
    )
    {
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}