<?php

namespace App\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDebtsRequest extends FormRequest
{
    public const FILE = 'file';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FILE => ['required', 'file', 'mimetypes:text/csv,text/plain']
        ];
    }
}