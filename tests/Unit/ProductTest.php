<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_product_with_valid_data()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 99.99,
            'stock' => 10,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99,
            'stock' => 10,
        ]);
    }

    /** @test */
    public function it_updates_a_product()
    {
        $product = Product::factory()->create();
        $product->update(['name' => 'Updated Name']);
        $this->assertEquals('Updated Name', $product->fresh()->name);
    }

    /** @test */
    public function it_deletes_a_product()
    {
        $product = Product::factory()->create();
        $product->delete();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

}
