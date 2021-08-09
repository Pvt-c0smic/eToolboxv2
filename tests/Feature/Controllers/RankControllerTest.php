<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Rank;

use App\Models\PersonnelType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_ranks()
    {
        $ranks = Rank::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('ranks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.ranks.index')
            ->assertViewHas('ranks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_rank()
    {
        $response = $this->get(route('ranks.create'));

        $response->assertOk()->assertViewIs('app.ranks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_rank()
    {
        $data = Rank::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('ranks.store'), $data);

        $this->assertDatabaseHas('rf_ranks', $data);

        $rank = Rank::latest('id')->first();

        $response->assertRedirect(route('ranks.edit', $rank));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_rank()
    {
        $rank = Rank::factory()->create();

        $response = $this->get(route('ranks.show', $rank));

        $response
            ->assertOk()
            ->assertViewIs('app.ranks.show')
            ->assertViewHas('rank');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_rank()
    {
        $rank = Rank::factory()->create();

        $response = $this->get(route('ranks.edit', $rank));

        $response
            ->assertOk()
            ->assertViewIs('app.ranks.edit')
            ->assertViewHas('rank');
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

        $response = $this->put(route('ranks.update', $rank), $data);

        $data['id'] = $rank->id;

        $this->assertDatabaseHas('rf_ranks', $data);

        $response->assertRedirect(route('ranks.edit', $rank));
    }

    /**
     * @test
     */
    public function it_deletes_the_rank()
    {
        $rank = Rank::factory()->create();

        $response = $this->delete(route('ranks.destroy', $rank));

        $response->assertRedirect(route('ranks.index'));

        $this->assertSoftDeleted($rank);
    }
}
