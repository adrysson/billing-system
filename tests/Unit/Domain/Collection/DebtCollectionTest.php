<?php

namespace Tests\Unit\Domain\Collection;

use App\Domain\Collection\DebtCollection;
use App\Domain\Iterator\DebtIterator;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entity\DebtStub;

class DebtCollectionTest extends TestCase
{
    public function test_should_push_method_add_debt_in_list_items()
    {
        $collection = new DebtCollection;

        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        foreach ($items as $item) {
            $collection->push($item);
        }

        $this->assertEquals(json_encode($items), json_encode($collection));
    }

    public function test_should_get_iterator_return_iterator_with_collection_items()
    {
        $collection = new DebtCollection;

        $items = [
            DebtStub::random(),
            DebtStub::random(),
            DebtStub::random(),
        ];

        foreach ($items as $item) {
            $collection->push($item);
        }

        $iterator = $collection->getIterator();

        while ($iterator->valid()) {
            $iteratorItems[] = $iterator->current();
            $iterator->next();
        }

        $this->assertEquals(json_encode($items), json_encode($iteratorItems));
    }
}