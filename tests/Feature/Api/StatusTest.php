<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Status;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
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
    public function it_gets_statuses_list()
    {
        $statuses = Status::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.statuses.index'));

        $response->assertOk()->assertSee($statuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_status()
    {
        $data = Status::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.statuses.store'), $data);

        $this->assertDatabaseHas('rf_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_status()
    {
        $status = Status::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'description' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.statuses.update', $status),
            $data
        );

        $data['id'] = $status->id;

        $this->assertDatabaseHas('rf_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_status()
    {
        $status = Status::factory()->create();

        $response = $this->deleteJson(route('api.statuses.destroy', $status));

        $this->assertDeleted($status);

        $response->assertNoContent();
    }
}
