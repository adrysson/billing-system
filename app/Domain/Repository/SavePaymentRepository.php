<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Payment;

interface SavePaymentRepository
{
    public function save(Payment $debt): bool;
}