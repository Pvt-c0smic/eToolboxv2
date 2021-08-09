<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ComplianceAction;

use App\Models\Compliance;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplianceActionTest extends TestCase
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
    public function it_gets_compliance_actions_list()
    {
        $complianceActions = ComplianceAction::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compliance-actions.index'));

        $response->assertOk()->assertSee($complianceActions[0]->updated_date);
    }

    /**
     * @test
     */
    public function it_stores_the_compliance_action()
    {
        $data = ComplianceAction::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.compliance-actions.store'),
            $data
        );

        $this->assertDatabaseHas('tr_compliance_actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.compliance-actions.update', $complianceAction),
            $data
        );

        $data['id'] = $complianceAction->id;

        $this->assertDatabaseHas('tr_compliance_actions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compliance_action()
    {
        $complianceAction = ComplianceAction::factory()->create();

        $response = $this->deleteJson(
            route('api.compliance-actions.destroy', $complianceAction)
        );

        $this->assertSoftDeleted($complianceAction);

        $response->assertNoContent();
    }
}
