<?php

namespace App\Presentation\Http\Controllers\V1\File;

use App\Application\SaveDebts\DebtsStorage;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\V1\File\FileStoreDebtsRequest;

class FileDebtController extends Controller
{
    public function __construct(
        private DebtsStorage $debtsStorage,
    )
    {
    }

    public function store(FileStoreDebtsRequest $request)
    {
        $response = ($this->debtsStorage)($request->debts());

        return response()->json($response);
    }
}
