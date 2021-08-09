<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rank;
use App\Models\PersonnelType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelTypeRanksTest extends TestCase
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
    public function it_gets_personnel_type_ranks()
    {
        $personnelType = PersonnelType::factory()->create();
        $ranks = Rank::factory()
            ->count(2)
            ->create([
                'personnel_type_id' => $personnelType->id,
            ]);

        $response = $this->getJson(
            route('api.personnel-types.ranks.index', $personnelType)
        );

        $response->assertOk()->assertSee($ranks[0]->code);
    }

    /**
     * @test
     */
    public function it_stores_the_personnel_type_ranks()
    {
        $personnelType = PersonnelType::factory()->create();
        $data = Rank::factory()
            ->make([
                'personnel_type_id' => $personnelType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.personnel-types.ranks.store', $personnelType),
            $data
        );

        $this->assertDatabaseHas('rf_ranks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $rank = Rank::latest('id')->first();

        $this->assertEquals($personnelType->id, $rank->personnel_type_id);
    }
}
