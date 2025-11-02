<?php

namespace Tests\Feature\Tracker\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_tracker_client(): void
    {
        $admin = User::factory()->create();

        Sanctum::actingAs($admin, ['tracker:manage']);

        $response = $this->postJson('/api/tracker/admin/clients', [
            'user_id' => $admin->id,
            'name' => 'Al-Manara',
            'company_name' => 'Al-Manara LLC',
            'contact_email' => 'owner@example.test',
            'contact_phone' => '+971500000000',
            'timezone' => 'Asia/Dubai',
            'currency_code' => 'AED',
            'notes' => 'VIP client',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.name', 'Al-Manara');
        $response->assertJsonPath('data.currency_code', 'AED');
        $response->assertJsonPath('data.projects_count', 0);
    }
}
