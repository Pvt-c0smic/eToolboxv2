<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rank;
use App\Models\Personnel;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankAllPersonnelTest extends TestCase
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
    public function it_gets_rank_all_personnel()
    {
        $rank = Rank::factory()->create();
        $allPersonnel = Personnel::factory()
            ->count(2)
            ->create([
                'rank_id' => $rank->id,
            ]);

        $response = $this->getJson(
            route('api.ranks.all-personnel.index', $rank)
        );

        $response->assertOk()->assertSee($allPersonnel[0]->last_name);
    }

    /**
     * @test
     */
    public function it_stores_the_rank_all_personnel()
    {
        $rank = Rank::factory()->create();
        $data = Personnel::factory()
            ->make([
                'rank_id' => $rank->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.ranks.all-personnel.store', $rank),
            $data
        );

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $personnel = Personnel::latest('id')->first();

        $this->assertEquals($rank->id, $personnel->rank_id);
    }
}
