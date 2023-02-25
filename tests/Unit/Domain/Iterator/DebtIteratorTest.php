<?php

namespace Tests\Unit\Domain\Iterator;

use App\Domain\Iterator\DebtIterator;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtIteratorTest extends TestCase
{
    public function test_should_current_method_return_current_debt(): void
    {
        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        $iterator = new DebtIterator($items);

        foreach ($items as $item) {
            $this->assertEquals($item, $iterator->current());
            $iterator->next();
        }
    }

    public function test_should_key_method_return_current_key_item(): void
    {
        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        $iterator = new DebtIterator($items);

        foreach ($items as $key => $item) {
            $this->assertEquals($key, $iterator->key());
            $iterator->next();
        }
    }

    public function test_should_rewind_method_return_to_first_item(): void
    {
        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        $iterator = new DebtIterator($items);

        $iterator->next();
        $iterator->next();

        $this->assertEquals(last($items), $iterator->current());

        $iterator->rewind();

        $this->assertEquals(current($items), $iterator->current());
    }

    public function test_should_valid_method_return_true_when_next_item_exists(): void
    {
        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        $iterator = new DebtIterator($items);

        $iterator->next();

        $this->assertTrue($iterator->valid());
    }

    public function test_should_valid_method_return_false_when_next_item_not_exists(): void
    {
        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        $iterator = new DebtIterator($items);

        while ($iterator->valid()) {
            $iterator->next();
        }

        $this->assertFalse($iterator->valid());
    }
}