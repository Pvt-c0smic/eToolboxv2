<?php

namespace Tests\Feature\Api;

use App\Models\Bos;
use App\Models\User;
use App\Models\Personnel;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BosAllPersonnelTest extends TestCase
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
    public function it_gets_bos_all_personnel()
    {
        $bos = Bos::factory()->create();
        $allPersonnel = Personnel::factory()
            ->count(2)
            ->create([
                'bos_id' => $bos->id,
            ]);

        $response = $this->getJson(
            route('api.all-bos.all-personnel.index', $bos)
        );

        $response->assertOk()->assertSee($allPersonnel[0]->last_name);
    }

    /**
     * @test
     */
    public function it_stores_the_bos_all_personnel()
    {
        $bos = Bos::factory()->create();
        $data = Personnel::factory()
            ->make([
                'bos_id' => $bos->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-bos.all-personnel.store', $bos),
            $data
        );

        $this->assertDatabaseHas('rf_personnel', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $personnel = Personnel::latest('id')->first();

        $this->assertEquals($bos->id, $personnel->bos_id);
    }
}
