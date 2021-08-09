<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Office;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeControllerTest extends TestCase
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
    public function it_displays_index_view_with_offices()
    {
        $offices = Office::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('offices.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.offices.index')
            ->assertViewHas('offices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_office()
    {
        $response = $this->get(route('offices.create'));

        $response->assertOk()->assertViewIs('app.offices.create');
    }

    /**
     * @test
     */
    public function it_stores_the_office()
    {
        $data = Office::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('offices.store'), $data);

        $this->assertDatabaseHas('rf_offices', $data);

        $office = Office::latest('id')->first();

        $response->assertRedirect(route('offices.edit', $office));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_office()
    {
        $office = Office::factory()->create();

        $response = $this->get(route('offices.show', $office));

        $response
            ->assertOk()
            ->assertViewIs('app.offices.show')
            ->assertViewHas('office');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_office()
    {
        $office = Office::factory()->create();

        $response = $this->get(route('offices.edit', $office));

        $response
            ->assertOk()
            ->assertViewIs('app.offices.edit')
            ->assertViewHas('office');
    }

    /**
     * @test
     */
    public function it_updates_the_office()
    {
        $office = Office::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'description' => $this->faker->text(255),
        ];

        $response = $this->put(route('offices.update', $office), $data);

        $data['id'] = $office->id;

        $this->assertDatabaseHas('rf_offices', $data);

        $response->assertRedirect(route('offices.edit', $office));
    }

    /**
     * @test
     */
    public function it_deletes_the_office()
    {
        $office = Office::factory()->create();

        $response = $this->delete(route('offices.destroy', $office));

        $response->assertRedirect(route('offices.index'));

        $this->assertDeleted($office);
    }
}
