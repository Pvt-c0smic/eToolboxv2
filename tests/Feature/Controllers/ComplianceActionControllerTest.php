<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ComplianceAction;

use App\Models\Compliance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplianceActionControllerTest extends TestCase
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
    public function it_displays_index_view_with_compliance_actions()
    {
        $complianceActions = ComplianceAction::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compliance-actions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compliance_actions.index')
            ->assertViewHas('complianceActions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compliance_action()
    {
        $response = $this->get(route('compliance-actions.create'));

        $response->assertOk()->assertViewIs('app.compliance_actions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compliance_action()
    {
        $data = ComplianceAction::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compliance-actions.store'), $data);

        $this->assertDatabaseHas('tr_compliance_actions', $data);

        $complianceAction = ComplianceAction::latest('id')->first();

        $response->assertRedirect(
            route('compliance-actions.edit', $complianceAction)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compliance_action()
    {
        $complianceAction = ComplianceAction::factory()->create();

        $response = $this->get(
            route('compliance-actions.show', $complianceAction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compliance_actions.show')
            ->assertViewHas('complianceAction');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compliance_action()
    {
        $complianceAction = ComplianceAction::factory()->create();

        $response = $this->get(
            route('compliance-actions.edit', $complianceAction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compliance_actions.edit')
            ->assertViewHas('complianceAction');
    }

    /**
     * @test
     */
    public function it_updates_the_compliance_action()
    {
        $complianceAction = ComplianceAction::factory()->create();

        $compliance = Compliance::factory()->create();

        $data = [
            'compliance_id' => $this->faker->randomNumber,
            'action_taken' => $this->faker->text,
            'commander_comment' => $this->faker->text,
            'percentage' => $this->faker->randomNumber(2),
            'updated_date' => $this->faker->date,
            'compliance_id' => $compliance->id,
        ];

        $response = $this->put(
            route('compliance-actions.update', $complianceAction),
            $data
        );

        $data['id'] = $complianceAction->id;

        $this->assertDatabaseHas('tr_compliance_actions', $data);

        $response->assertRedirect(
            route('compliance-actions.edit', $complianceAction)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_compliance_action()
    {
        $complianceAction = ComplianceAction::factory()->create();

        $response = $this->delete(
            route('compliance-actions.destroy', $complianceAction)
        );

        $response->assertRedirect(route('compliance-actions.index'));

        $this->assertSoftDeleted($complianceAction);
    }
}
