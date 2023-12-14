<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_canAccessSalesPageWhenLoggedIn()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/sales');
        $response->assertStatus(200);
    }

    public function test_canNotAccessSalesPageWhenNotLoggedIn()
    {
        $response = $this->get('/sales');
        $response->assertStatus(302);
    }
}
