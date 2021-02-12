<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_api_can_list_products()
    {
        Product::factory()->count(3)->create();

        $this->getJson('/api/products')->assertStatus(200)->assertJsonCount(3);
    }

    public function test_api_returns_single_product()
    {
        $product = Product::factory()->count(1)->create()->first();

        $this->getJson(route('products.show', $product->slug))
            ->assertStatus(200)
            ->assertJson([
                "product" => []
            ]);
    }

    public function test_api_returns_product_logs()
    {
        $product = Product::factory()->count(1)->create()->first();

        $this->getJson(route('products.show', $product->slug))
            ->assertStatus(200)
            ->assertJson([
                "logs" => []
            ]);
    }

    public function test_can_create_product()
    {
        $products = [ "products" => Product::factory()->count(1)->make()->toArray() ];   

        $this->postJson(route('products.store'), $products)->assertStatus(201);
        $this->assertDatabaseHas('products', $products['products'][0]);
    }

    public function test_can_update_product()
    {
        $existingProduct = Product::factory()->count(1)->create()->first();
        $name = $this->faker->name;
        $productUpdate = [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
        ];
        
        $this->putJson(route('products.update', $existingProduct->slug), $productUpdate)->assertStatus(200);
        $this->assertDatabaseHas('products', $productUpdate);
    }

    public function test_can_delete_product()
    {
        $product = Product::factory()->count(1)->create()->first();

        $this->deleteJson(route('products.destroy', $product->slug))->assertStatus(200);
        $this->assertDatabaseMissing('products', $product->toArray());
    }
}
