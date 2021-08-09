<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PersonnelType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_personnel_types()
    {
        $personnelTypes = PersonnelType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('personnel-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.personnel_types.index')
            ->assertViewHas('personnelTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_personnel_type()
    {
        $response = $this->get(route('personnel-types.create'));

        $response->assertOk()->assertViewIs('app.personnel_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_personnel_type()
    {
        $data = PersonnelType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('personnel-types.store'), $data);

        $this->assertDatabaseHas('rf_personnel_types', $data);

        $personnelType = PersonnelType::latest('id')->first();

        $response->assertRedirect(
            route('personnel-types.edit', $personnelType)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_personnel_type()
    {
        $personnelType = PersonnelType::factory()->create();

        $response = $this->get(route('personnel-types.show', $personnelType));

        $response
            ->assertOk()
            ->assertViewIs('app.personnel_types.show')
            ->assertViewHas('personnelType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_personnel_type()
    {
        $personnelType = PersonnelType::factory()->create();

        $response = $this->get(route('personnel-types.edit', $personnelType));

        $response
            ->assertOk()
            ->assertViewIs('app.personnel_types.edit')
            ->assertViewHas('personnelType');
    }

    /**
     * @test
     */
    public function it_updates_the_personnel_type()
    {
        $personnelType = PersonnelType::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('personnel-types.update', $personnelType),
            $data
        );

        $data['id'] = $personnelType->id;

        $this->assertDatabaseHas('rf_personnel_types', $data);

        $response->assertRedirect(
            route('personnel-types.edit', $personnelType)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_personnel_type()
    {
        $personnelType = PersonnelType::factory()->create();

        $response = $this->delete(
            route('personnel-types.destroy', $personnelType)
        );

        $response->assertRedirect(route('personnel-types.index'));

        $this->assertSoftDeleted($personnelType);
    }
}
