<?php

namespace Tests\Feature\Presentation\Http\Controllers\V1\Csv;

use App\Application\SaveDebts\DebtsStorageResponse;
use App\Domain\Enum\DebtsStorageStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileDebtControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_should_return_success_response_when_upload_debts_file_saved_sucessful(): void
    {
        $response = $this->postJson('/api/v1/file/debts', [
            'file' => new UploadedFile(resource_path('examples/debts-example.csv'), 'debts-example.csv', null, null, true)
        ]);

        $response->assertStatus(200);

        $expectedResponse = new DebtsStorageResponse(DebtsStorageStatus::SUCCESS);

        $this->assertEquals(json_encode($expectedResponse), json_encode($response->original));
    }

    public function test_should_return_error_response_when_upload_debts_file_has_errors()
    {
        $response = $this->postJson('/api/v1/file/debts', [
            'file' => new UploadedFile(resource_path('examples/debts-with-errors-example.csv'), 'debts-example.csv', null, null, true)
        ]);

        $response->assertStatus(422);
    }
}