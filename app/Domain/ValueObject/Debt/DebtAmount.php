<?php

namespace App\Domain\ValueObject\Debt;

class DebtAmount implements \JsonSerializable
{
    protected function __construct(
        public readonly float $value
    )
    {
    }

    public static function create(float $value): self
    {
        return new self($value);
    }

    public function jsonSerialize(): float
    {
        return $this->value;
    }
}