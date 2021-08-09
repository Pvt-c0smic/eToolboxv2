<?php

namespace Tests\Feature\Controllers;

use App\Models\Bos;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BosControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_bos()
    {
        $allBos = Bos::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-bos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bos.index')
            ->assertViewHas('allBos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bos()
    {
        $response = $this->get(route('all-bos.create'));

        $response->assertOk()->assertViewIs('app.all_bos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bos()
    {
        $data = Bos::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-bos.store'), $data);

        $this->assertDatabaseHas('rf_bos', $data);

        $bos = Bos::latest('id')->first();

        $response->assertRedirect(route('all-bos.edit', $bos));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bos()
    {
        $bos = Bos::factory()->create();

        $response = $this->get(route('all-bos.show', $bos));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bos.show')
            ->assertViewHas('bos');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bos()
    {
        $bos = Bos::factory()->create();

        $response = $this->get(route('all-bos.edit', $bos));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bos.edit')
            ->assertViewHas('bos');
    }

    /**
     * @test
     */
    public function it_updates_the_bos()
    {
        $bos = Bos::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'description' => $this->faker->text(255),
        ];

        $response = $this->put(route('all-bos.update', $bos), $data);

        $data['id'] = $bos->id;

        $this->assertDatabaseHas('rf_bos', $data);

        $response->assertRedirect(route('all-bos.edit', $bos));
    }

    /**
     * @test
     */
    public function it_deletes_the_bos()
    {
        $bos = Bos::factory()->create();

        $response = $this->delete(route('all-bos.destroy', $bos));

        $response->assertRedirect(route('all-bos.index'));

        $this->assertSoftDeleted($bos);
    }
}
