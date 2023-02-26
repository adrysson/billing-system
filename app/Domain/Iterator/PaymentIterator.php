<?php

namespace App\Domain\Iterator;

use App\Domain\Entity\Payment;

class PaymentIterator implements \Iterator
{
    private int $key = 0;

    public function __construct(private array $items)
    {
    }

    public function current(): Payment
    {
        return $this->items[$this->key];
    }

    public function key(): int
    {
        return $this->key;
    }

    public function next()
    {
        $this->key++;
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->key]);
    }
}