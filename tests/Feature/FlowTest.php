namespace Tests\Feature;

use App\Models\Client;
use App\Models\Gateway;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TransactionCheckoutTest extends TestCase
{
use RefreshDatabase;

public function test_it_can_process_a_successful_transaction()
{
// 1. Arrange (Preparação)
// Criamos dados falsos no banco em memória usando Factories
$client = Client::factory()->create();
$product = Product::factory()->create(['amount' => 1000]); // Produto de R$ 10,00
$gateway = Gateway::factory()->create(['priority' => 1, 'is_active' => true, 'name' => 'Gateway 1']);

// Interceptamos as chamadas HTTP (Mock).
// Quando o Laravel tentar chamar o Mock do Docker, ele vai retornar isso instantaneamente:
Http::fake([
'*' => Http::response(['success' => true, 'id' => 'transacao-123'], 201)
]);

// 2. Act (Ação)
// Disparamos um POST para a rota que ainda nem existe!
$response = $this->postJson('/api/transactions', [
'client_id' => $client->id,
'product_id' => $product->id,
'quantity' => 2,
'cardNumber' => '5569000000006063',
'cvv' => '010',
]);

// 3. Assert (Asserção)
// O que esperamos que aconteça?
$response->assertStatus(201); // O status code deve ser 201 Created

// Verificamos se a transação foi salva no banco de dados corretamente
$this->assertDatabaseHas('transactions', [
'client_id' => $client->id,
'product_id' => $product->id,
'amount' => 2000, // R$ 10,00 * 2 quantidades
'status' => 'paid',
'gateway_id' => $gateway->id,
]);
}
}