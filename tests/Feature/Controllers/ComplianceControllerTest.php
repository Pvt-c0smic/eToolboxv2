<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Compliance;

use App\Models\Office;
use App\Models\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplianceControllerTest extends TestCase
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
    public function it_displays_index_view_with_compliances()
    {
        $compliances = Compliance::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compliances.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compliances.index')
            ->assertViewHas('compliances');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compliance()
    {
        $response = $this->get(route('compliances.create'));

        $response->assertOk()->assertViewIs('app.compliances.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compliance()
    {
        $data = Compliance::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compliances.store'), $data);

        $this->assertDatabaseHas('tr_compliances', $data);

        $compliance = Compliance::latest('id')->first();

        $response->assertRedirect(route('compliances.edit', $compliance));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compliance()
    {
        $compliance = Compliance::factory()->create();

        $response = $this->get(route('compliances.show', $compliance));

        $response
            ->assertOk()
            ->assertViewIs('app.compliances.show')
            ->assertViewHas('compliance');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compliance()
    {
        $compliance = Compliance::factory()->create();

        $response = $this->get(route('compliances.edit', $compliance));

        $response
            ->assertOk()
            ->assertViewIs('app.compliances.edit')
            ->assertViewHas('compliance');
    }

    /**
     * @test
     */
    public function it_updates_the_compliance()
    {
        $compliance = Compliance::factory()->create();

        $office = Office::factory()->create();
        $status = Status::factory()->create();

        $data = [
            'office_id' => $this->faker->randomNumber,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'project_name' => $this->faker->text(255),
            'status_id' => $this->faker->randomNumber,
            'office_id' => $office->id,
            'status_id' => $status->id,
        ];

        $response = $this->put(route('compliances.update', $compliance), $data);

        $data['id'] = $compliance->id;

        $this->assertDatabaseHas('tr_compliances', $data);

        $response->assertRedirect(route('compliances.edit', $compliance));
    }

    /**
     * @test
     */
    public function it_deletes_the_compliance()
    {
        $compliance = Compliance::factory()->create();

        $response = $this->delete(route('compliances.destroy', $compliance));

        $response->assertRedirect(route('compliances.index'));

        $this->assertSoftDeleted($compliance);
    }
}
