<?php

namespace App\Presentation\Http\Requests\V1\File;

use App\Domain\Adapter\FileDebtReceiver;
use App\Domain\Collection\DebtCollection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;

class FileStoreDebtsRequest extends FormRequest
{
    public const FILE = 'file';

    private FileDebtReceiver $fileDebtReceiver;

    private DebtCollection $debts;

    public function authorize(): bool
    {
        $this->fileDebtReceiver = app(FileDebtReceiver::class);

        return true;
    }

    public function rules(): array
    {
        return [
            self::FILE => ['required', 'file', 'mimetypes:text/csv,text/plain']
        ];
    }

    public function withValidator(Validator $validator)
    {
        $file = $this?->{self::FILE};

        if ($file && $file instanceof UploadedFile) {
            $validator->after(function (Validator $validator) use ($file) {
                try {
                    $this->debts = $this->fileDebtReceiver->receive($file);
                } catch (\Throwable $th) {
                    $validator->errors()->add(self::FILE, $th->getMessage());
                }
            });
        }
    }

    public function debts(): DebtCollection
    {
        return $this->debts;
    }
}