<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Compliance;

use App\Models\Office;
use App\Models\Status;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplianceTest extends TestCase
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
    public function it_gets_compliances_list()
    {
        $compliances = Compliance::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compliances.index'));

        $response->assertOk()->assertSee($compliances[0]->start_date);
    }

    /**
     * @test
     */
    public function it_stores_the_compliance()
    {
        $data = Compliance::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.compliances.store'), $data);

        $this->assertDatabaseHas('tr_compliances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.compliances.update', $compliance),
            $data
        );

        $data['id'] = $compliance->id;

        $this->assertDatabaseHas('tr_compliances', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compliance()
    {
        $compliance = Compliance::factory()->create();

        $response = $this->deleteJson(
            route('api.compliances.destroy', $compliance)
        );

        $this->assertSoftDeleted($compliance);

        $response->assertNoContent();
    }
}
