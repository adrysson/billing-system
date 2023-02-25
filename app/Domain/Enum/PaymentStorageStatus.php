<?php

namespace App\Domain\Enum;

enum PaymentStorageStatus
{
    case IN_PROGRESS;
    case SUCCESS;
    case FAILED;
}