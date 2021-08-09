<?php

namespace Tests\Feature\Api;

use App\Models\Bos;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BosTest extends TestCase
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
    public function it_gets_all_bos_list()
    {
        $allBos = Bos::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-bos.index'));

        $response->assertOk()->assertSee($allBos[0]->code);
    }

    /**
     * @test
     */
    public function it_stores_the_bos()
    {
        $data = Bos::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-bos.store'), $data);

        $this->assertDatabaseHas('rf_bos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bos()
    {
        $bos = Bos::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'description' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.all-bos.update', $bos), $data);

        $data['id'] = $bos->id;

        $this->assertDatabaseHas('rf_bos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bos()
    {
        $bos = Bos::factory()->create();

        $response = $this->deleteJson(route('api.all-bos.destroy', $bos));

        $this->assertSoftDeleted($bos);

        $response->assertNoContent();
    }
}
