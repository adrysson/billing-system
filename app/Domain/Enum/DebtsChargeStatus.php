<?php

namespace App\Domain\Enum;

enum DebtsChargeStatus
{
    case IN_PROGRESS;
    case SUCCESS;
    case FAILED;
}