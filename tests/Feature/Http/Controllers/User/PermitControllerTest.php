<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;
use App\Permit;

class PermitControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPermitData()
    {
        $user = factory(Permit::class)->create();

        $response = $this->getJson('/api/permit-all');

        $response->assertStatus(401);
    }
}