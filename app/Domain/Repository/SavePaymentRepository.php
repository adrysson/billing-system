<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Payment;
use App\Domain\Enum\PaymentStorageStatus;

interface SavePaymentRepository
{
    public function save(Payment $debt): PaymentStorageStatus;
}