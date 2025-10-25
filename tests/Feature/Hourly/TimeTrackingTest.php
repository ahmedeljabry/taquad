<?php

namespace Tests\Feature\Hourly;

use App\Actions\Hourly\StartTimerAction;
use App\Actions\Hourly\StopTimerAction;
use App\Models\Contract;
use App\Models\Project;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TimeTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_start_and_stop_timer_creates_entry(): void
    {
        $client = User::factory()->create();
        $freelancer = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $client->id, 'budget_type' => 'hourly']);
        $contract = Contract::factory()->create([
            'project_id'    => $project->id,
            'client_id'     => $client->id,
            'freelancer_id' => $freelancer->id,
            'status'        => 'active',
            'hourly_rate'   => 50,
        ]);

        $start = app(StartTimerAction::class)->handle($contract, $freelancer->id);
        $this->assertInstanceOf(TimeEntry::class, $start);

        $stop = app(StopTimerAction::class)->handle($contract, $freelancer->id);
        $this->assertNotNull($stop->ended_at);
    }
}

