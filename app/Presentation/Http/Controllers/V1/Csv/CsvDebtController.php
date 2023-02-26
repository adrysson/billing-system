<?php

namespace App\Presentation\Http\Controllers\V1\Csv;

use App\Application\SaveDebts\DebtsStorage;
use App\Domain\Adapter\DebtReceiver;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\StoreDebtsRequest;

class CsvDebtController extends Controller
{
    public function __construct(
        private DebtReceiver $debtReceiver,
        private DebtsStorage $debtsStorage,
    )
    {
    }

    public function store(StoreDebtsRequest $request)
    {
        $debts = $this->debtReceiver->receive($request->file);

        $response = ($this->debtsStorage)($debts);

        return response()->json($response);
    }
}
