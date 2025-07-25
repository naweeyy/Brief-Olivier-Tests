<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_products()
    {
        Product::factory()->count(3)->create();
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    /** @test */
    public function it_creates_a_product()
    {
        $data = [
            'name' => 'New Product',
            'price' => 49.99,
            'stock' => 5,
        ];
        $response = $this->post(route('products.store'), $data);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $data);
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_validates_product_creation()
    {
        $response = $this->post(route('products.store'), [
            'name' => '',
            'price' => 'not-a-number',
            'stock' => 'not-an-integer',
        ]);
        $response->assertSessionHasErrors(['name', 'price', 'stock']);
    }

    /** @test */
    public function it_updates_a_product()
    {
        $product = Product::factory()->create();
        $data = [
            'name' => 'Updated',
            'price' => 100,
            'stock' => 20,
        ];
        $response = $this->put(route('products.update', $product), $data);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $data);
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_deletes_a_product()
    {
        $product = Product::factory()->create();
        $response = $this->delete(route('products.destroy', $product));
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertSessionHas('success');
    }
}
