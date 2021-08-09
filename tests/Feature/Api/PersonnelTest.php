<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Personnel;

use App\Models\Bos;
use App\Models\Rank;
use App\Models\Office;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonnelTest extends TestCase
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
    public function it_gets_all_personnel_list()
    {
        $allPersonnel = Personnel::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-personnel.index'));

        $response->assertOk()->assertSee($allPersonnel[0]->last_name);
    }

    /**
     * @test
     */
    public function it_stores_the_personnel()
    {
        $data = Personnel::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-personnel.store'), $data);

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-personnel.update', $personnel),
            $data
        );

        $data['id'] = $personnel->id;

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_personnel()
    {
        $personnel = Personnel::factory()->create();

        $response = $this->deleteJson(
            route('api.all-personnel.destroy', $personnel)
        );

        $this->assertDeleted($personnel);

        $response->assertNoContent();
    }
}
