<?php

namespace App\Presentation\Http\Requests\V1\Csv;

use Illuminate\Foundation\Http\FormRequest;

class CsvStoreDebtsRequest extends FormRequest
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