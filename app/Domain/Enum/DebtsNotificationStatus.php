<?php

namespace App\Domain\Enum;

enum DebtsNotificationStatus
{
    case IN_PROGRESS;
    case SUCCESS;
    case FAILED;
}