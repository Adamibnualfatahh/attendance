<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AnnualLeave;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeaveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_annual_leaves()
    {
        $response = $this->getJson('/api/annual-leaves');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_annual_leave()
    {
        $user = factory(User::class)->create();

        $data = [
            'user_id' => $user->id,
            'reason' => 'Test reason',
            'status' => 'pending',
            'leave_dates' => [
                ['leave_date' => '2024-02-01'],
                ['leave_date' => '2024-02-02'],
                ['leave_date' => '2024-02-03'],
            ],
        ];

        $response = $this->postJson('/api/annual-leaves', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user_id',
                'reason',
                'status',
                'created_at',
                'updated_at',
                'leave_dates',
            ]);

        $this->assertDatabaseHas('annual_leaves', [
            'user_id' => $data['user_id'],
            'reason' => $data['reason'],
            'status' => $data['status'],
        ]);
    }


    /** @test */
    public function it_can_get_annual_leave_by_id()
    {
        $annualLeave = factory(AnnualLeave::class)->create();

        $response = $this->getJson('/api/annual-leaves/' . $annualLeave->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'user_id',
                'reason',
                'status',
                'created_at',
                'updated_at',
                'leave_dates',
            ]);
    }

    /** @test */
    public function it_validates_required_fields_on_create()
    {
        $response = $this->postJson('/api/annual-leaves', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id', 'reason']);
    }


    /** @test */
    public function it_generates_code_coverage_report()
    {
        $coverageFile = base_path('reports/');
        exec("phpunit --coverage-html {$coverageFile}");

        $this->assertFileExists($coverageFile);
    }
}
