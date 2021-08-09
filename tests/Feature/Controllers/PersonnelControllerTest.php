<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Personnel;

use App\Models\Bos;
use App\Models\Rank;
use App\Models\Office;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_personnel()
    {
        $allPersonnel = Personnel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-personnel.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_personnel.index')
            ->assertViewHas('allPersonnel');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_personnel()
    {
        $response = $this->get(route('all-personnel.create'));

        $response->assertOk()->assertViewIs('app.all_personnel.create');
    }

    /**
     * @test
     */
    public function it_stores_the_personnel()
    {
        $data = Personnel::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-personnel.store'), $data);

        $this->assertDatabaseHas('rf_personnel', $data);

        $personnel = Personnel::latest('id')->first();

        $response->assertRedirect(route('all-personnel.edit', $personnel));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_personnel()
    {
        $personnel = Personnel::factory()->create();

        $response = $this->get(route('all-personnel.show', $personnel));

        $response
            ->assertOk()
            ->assertViewIs('app.all_personnel.show')
            ->assertViewHas('personnel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_personnel()
    {
        $personnel = Personnel::factory()->create();

        $response = $this->get(route('all-personnel.edit', $personnel));

        $response
            ->assertOk()
            ->assertViewIs('app.all_personnel.edit')
            ->assertViewHas('personnel');
    }

    /**
     * @test
     */
    public function it_updates_the_personnel()
    {
        $personnel = Personnel::factory()->create();

        $bos = Bos::factory()->create();
        $rank = Rank::factory()->create();
        $office = Office::factory()->create();

        $data = [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->text(255),
            'email' => $this->faker->text(255),
            'phone_number' => $this->faker->phoneNumber,
            'afpsn' => $this->faker->text(255),
            'address' => $this->faker->text,
            'rank_id' => $this->faker->randomNumber,
            'bos_id' => $this->faker->randomNumber,
            'office_id' => $this->faker->randomNumber,
            'designation' => $this->faker->text(255),
            'bos_id' => $bos->id,
            'rank_id' => $rank->id,
            'office_id' => $office->id,
        ];

        $response = $this->put(
            route('all-personnel.update', $personnel),
            $data
        );

        $data['id'] = $personnel->id;

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertRedirect(route('all-personnel.edit', $personnel));
    }

    /**
     * @test
     */
    public function it_deletes_the_personnel()
    {
        $personnel = Personnel::factory()->create();

        $response = $this->delete(route('all-personnel.destroy', $personnel));

        $response->assertRedirect(route('all-personnel.index'));

        $this->assertDeleted($personnel);
    }
}
