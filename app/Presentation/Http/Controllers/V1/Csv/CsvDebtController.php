<?php

namespace App\Presentation\Http\Controllers\V1\Csv;

use App\Application\SaveDebts\DebtsStorage;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\V1\Csv\CsvStoreDebtsRequest;

class CsvDebtController extends Controller
{
    public function __construct(
        private DebtsStorage $debtsStorage,
    )
    {
    }

    public function store(CsvStoreDebtsRequest $request)
    {
        $response = ($this->debtsStorage)($request->debts());

        return response()->json($response);
    }
}
