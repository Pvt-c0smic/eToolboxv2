<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Status;
use App\Models\Compliance;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusCompliancesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_status_compliances()
    {
        $status = Status::factory()->create();
        $compliances = Compliance::factory()
            ->count(2)
            ->create([
                'status_id' => $status->id,
            ]);

        $response = $this->getJson(
            route('api.statuses.compliances.index', $status)
        );

        $response->assertOk()->assertSee($compliances[0]->start_date);
    }

    /**
     * @test
     */
    public function it_stores_the_status_compliances()
    {
        $status = Status::factory()->create();
        $data = Compliance::factory()
            ->make([
                'status_id' => $status->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.statuses.compliances.store', $status),
            $data
        );

        $this->assertDatabaseHas('tr_compliances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compliance = Compliance::latest('id')->first();

        $this->assertEquals($status->id, $compliance->status_id);
    }
}
