<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Office;
use App\Models\Compliance;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeCompliancesTest extends TestCase
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
    public function it_gets_office_compliances()
    {
        $office = Office::factory()->create();
        $compliances = Compliance::factory()
            ->count(2)
            ->create([
                'office_id' => $office->id,
            ]);

        $response = $this->getJson(
            route('api.offices.compliances.index', $office)
        );

        $response->assertOk()->assertSee($compliances[0]->start_date);
    }

    /**
     * @test
     */
    public function it_stores_the_office_compliances()
    {
        $office = Office::factory()->create();
        $data = Compliance::factory()
            ->make([
                'office_id' => $office->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.offices.compliances.store', $office),
            $data
        );

        $this->assertDatabaseHas('tr_compliances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compliance = Compliance::latest('id')->first();

        $this->assertEquals($office->id, $compliance->office_id);
    }
}
