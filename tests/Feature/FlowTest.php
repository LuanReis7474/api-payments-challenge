<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Gateway;


class PortfolioFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_flow_with_session(): void
    {
        $this->withSession(['test_user' => true]);

        $client = Client::factory()->create();
        $product = Product::factory()->create(['amount' => 1000]);
        $gateway = Gateway::factory()->create(['priority' => 1, 'is_active' => true, 'name' => 'Gateway 1']);

        Http::fake([
            '*' => Http::response(['success' => true, 'id' => 'transacao-123'], 201)
        ]);

        $response = $this->postJson('/api/transactions', [
            'client_id' => $client->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'cardNumber' => '5569000000006063',
            'cvv' => '010',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('transactions', [
            'client_id' => $client->id,
            'product_id' => $product->id,
            'amount' => 2000,
            'status' => 'paid',
            'gateway_id' => $gateway->id,
        ]);
    }
}
