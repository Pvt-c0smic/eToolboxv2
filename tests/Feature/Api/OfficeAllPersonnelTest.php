<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Office;
use App\Models\Personnel;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeAllPersonnelTest extends TestCase
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
    public function it_gets_office_all_personnel()
    {
        $office = Office::factory()->create();
        $allPersonnel = Personnel::factory()
            ->count(2)
            ->create([
                'office_id' => $office->id,
            ]);

        $response = $this->getJson(
            route('api.offices.all-personnel.index', $office)
        );

        $response->assertOk()->assertSee($allPersonnel[0]->last_name);
    }

    /**
     * @test
     */
    public function it_stores_the_office_all_personnel()
    {
        $office = Office::factory()->create();
        $data = Personnel::factory()
            ->make([
                'office_id' => $office->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.offices.all-personnel.store', $office),
            $data
        );

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $personnel = Personnel::latest('id')->first();

        $this->assertEquals($office->id, $personnel->office_id);
    }
}
