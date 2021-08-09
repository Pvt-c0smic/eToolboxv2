<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rank;

use App\Models\PersonnelType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankTest extends TestCase
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
    public function it_gets_ranks_list()
    {
        $ranks = Rank::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.ranks.index'));

        $response->assertOk()->assertSee($ranks[0]->code);
    }

    /**
     * @test
     */
    public function it_stores_the_rank()
    {
        $data = Rank::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.ranks.store'), $data);

        $this->assertDatabaseHas('rf_ranks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_rank()
    {
        $rank = Rank::factory()->create();

        $personnelType = PersonnelType::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'description' => $this->faker->text(255),
            'personnel_type_id' => $this->faker->randomNumber,
            'personnel_type_id' => $personnelType->id,
        ];

        $response = $this->putJson(route('api.ranks.update', $rank), $data);

        $data['id'] = $rank->id;

        $this->assertDatabaseHas('rf_ranks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_rank()
    {
        $rank = Rank::factory()->create();

        $response = $this->deleteJson(route('api.ranks.destroy', $rank));

        $this->assertSoftDeleted($rank);

        $response->assertNoContent();
    }
}
