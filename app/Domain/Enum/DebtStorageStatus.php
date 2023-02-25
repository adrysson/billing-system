<?php

namespace App\Domain\Enum;

enum DebtStorageStatus
{
    case IN_PROGRESS;
    case SUCCESS;
    case FAILED;
}