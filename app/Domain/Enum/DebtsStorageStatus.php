<?php

namespace App\Domain\Enum;

enum DebtsStorageStatus
{
    case IN_PROGRESS;
    case SUCCESS;
    case FAILED;
}