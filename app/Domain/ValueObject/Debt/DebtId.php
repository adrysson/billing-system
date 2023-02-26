<?php

namespace App\Domain\ValueObject\Debt;

class DebtId implements \JsonSerializable
{
    protected function __construct(
        public readonly int $value
    )
    {
    }

    public static function create(int $value): self
    {
        return new self($value);
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}