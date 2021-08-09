<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PersonnelType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelTypeTest extends TestCase
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
    public function it_gets_personnel_types_list()
    {
        $personnelTypes = PersonnelType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.personnel-types.index'));

        $response->assertOk()->assertSee($personnelTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_personnel_type()
    {
        $data = PersonnelType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.personnel-types.store'), $data);

        $this->assertDatabaseHas('rf_personnel_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.personnel-types.update', $personnelType),
            $data
        );

        $data['id'] = $personnelType->id;

        $this->assertDatabaseHas('rf_personnel_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_personnel_type()
    {
        $personnelType = PersonnelType::factory()->create();

        $response = $this->deleteJson(
            route('api.personnel-types.destroy', $personnelType)
        );

        $this->assertDeleted($personnelType);

        $response->assertNoContent();
    }
}
