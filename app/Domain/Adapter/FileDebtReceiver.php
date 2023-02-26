<?php

namespace App\Domain\Adapter;

use App\Domain\Collection\DebtCollection;

interface FileDebtReceiver
{
    public function receive(\SplFileInfo $file): DebtCollection;
}