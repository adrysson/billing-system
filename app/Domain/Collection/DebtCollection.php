<?php

namespace App\Domain\Collection;

use App\Domain\Entity\Debt;
use App\Domain\Iterator\DebtIterator;

class DebtCollection implements \IteratorAggregate, \JsonSerializable
{
    private array $items = [];

    public function push(Debt $debt): void
    {
        $this->items[] = $debt;
    }

    public function getIterator(): DebtIterator
    {
        return new DebtIterator($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}