<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Compliance;
use App\Models\ComplianceAction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplianceComplianceActionsTest extends TestCase
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
    public function it_gets_compliance_compliance_actions()
    {
        $compliance = Compliance::factory()->create();
        $complianceActions = ComplianceAction::factory()
            ->count(2)
            ->create([
                'compliance_id' => $compliance->id,
            ]);

        $response = $this->getJson(
            route('api.compliances.compliance-actions.index', $compliance)
        );

        $response->assertOk()->assertSee($complianceActions[0]->updated_date);
    }

    /**
     * @test
     */
    public function it_stores_the_compliance_compliance_actions()
    {
        $compliance = Compliance::factory()->create();
        $data = ComplianceAction::factory()
            ->make([
                'compliance_id' => $compliance->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.compliances.compliance-actions.store', $compliance),
            $data
        );

        $this->assertDatabaseHas('tr_compliance_actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $complianceAction = ComplianceAction::latest('id')->first();

        $this->assertEquals($compliance->id, $complianceAction->compliance_id);
    }
}
