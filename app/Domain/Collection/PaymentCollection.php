<?php

namespace App\Domain\Collection;

use App\Domain\Entity\Payment;
use App\Domain\Iterator\PaymentIterator;

class PaymentCollection implements \IteratorAggregate, \JsonSerializable
{
    private array $items = [];

    public function push(Payment $payment): void
    {
        $this->items[] = $payment;
    }

    public function getIterator(): PaymentIterator
    {
        return new PaymentIterator($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}