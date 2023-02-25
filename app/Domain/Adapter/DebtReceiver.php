<?php

namespace App\Domain\Adapter;

use App\Domain\Collection\DebtCollection;

interface DebtReceiver
{
    public function receive(\SplFileInfo $file): DebtCollection;
}