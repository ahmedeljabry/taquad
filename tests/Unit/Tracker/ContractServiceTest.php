<?php

namespace Tests\Unit\Tracker;

use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\TrackerClient;
use App\Models\TrackerProject;
use App\Models\User;
use App\Services\Tracker\ContractService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ContractServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_contract_and_enforces_unique_active(): void
    {
        $clientUser = User::factory()->create();
        $freelancer = User::factory()->create();
        $creator = User::factory()->create();

        $trackerClient = TrackerClient::create([
            'user_id' => $clientUser->id,
            'name' => 'Acme Corp',
            'company_name' => 'Acme Corp',
            'contact_email' => 'billing@example.test',
        ]);

        $project = TrackerProject::create([
            'tracker_client_id' => $trackerClient->id,
            'created_by' => $creator->id,
            'name' => 'New Platform Build',
            'reference_code' => 'PRJ-001',
            'is_active' => true,
        ]);

        $service = app(ContractService::class);

        $first = $service->create([
            'tracker_project_id' => $project->id,
            'client_id' => $clientUser->id,
            'freelancer_id' => $freelancer->id,
            'type' => 'hourly',
            'status' => ContractStatus::Active,
            'hourly_rate' => 55,
            'weekly_limit_hours' => 40,
            'allow_manual_time' => false,
            'auto_approve_low_activity' => false,
            'currency_code' => 'USD',
            'created_by' => $creator->id,
        ]);

        $this->assertInstanceOf(Contract::class, $first);
        $this->assertTrue($first->status === ContractStatus::Active);

        $this->expectException(ValidationException::class);

        $service->create([
            'tracker_project_id' => $project->id,
            'client_id' => $clientUser->id,
            'freelancer_id' => $freelancer->id,
            'type' => 'hourly',
            'status' => ContractStatus::Active,
            'hourly_rate' => 60,
            'weekly_limit_hours' => 30,
            'allow_manual_time' => true,
            'auto_approve_low_activity' => true,
            'currency_code' => 'USD',
            'created_by' => $creator->id,
        ]);
    }
}
