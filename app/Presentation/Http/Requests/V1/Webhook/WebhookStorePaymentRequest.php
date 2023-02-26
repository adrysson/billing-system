<?php

namespace App\Presentation\Http\Requests\V1\Webhook;

use Illuminate\Foundation\Http\FormRequest;

class WebhookStorePaymentRequest extends FormRequest
{
    public const DEBT_ID = 'debtId';
    public const PAID_AT = 'paidAt';
    public const PAID_AMOUNT = 'paidAmount';
    public const PAID_BY = 'paidBy';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::DEBT_ID => ['required', 'integer', 'exists:debts,id'],
            self::PAID_AT => ['required', 'date'],
            self::PAID_AMOUNT => ['required', 'decimal:0,2'],
            self::PAID_BY => ['required', 'string'],
        ];
    }
}