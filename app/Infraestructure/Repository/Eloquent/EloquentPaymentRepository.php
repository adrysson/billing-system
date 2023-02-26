<?php

namespace App\Infraestructure\Repository\Eloquent;

use App\Domain\Entity\Payment;
use App\Domain\Enum\PaymentStorageStatus;
use App\Domain\Repository\SavePaymentRepository;
use \App\Infraestructure\Models\Payment as PaymentModel;

class EloquentPaymentRepository implements SavePaymentRepository
{
    public function save(Payment $payment): PaymentStorageStatus
    {
        $data = [
            PaymentModel::DEBT_ID => $payment->debt->id->value,
            PaymentModel::PAID_AT => $payment->paymentTime->value,
            PaymentModel::AMOUNT => $payment->amount->value,
            PaymentModel::PAID_BY => $payment->payerName->value,
        ];

        if (PaymentModel::insert($data)) {
            return PaymentStorageStatus::SUCCESS;
        }

        return PaymentStorageStatus::FAILED;
    }
}