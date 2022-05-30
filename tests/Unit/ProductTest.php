<?php

namespace Tests\Unit;

use Modules\Product\Entities\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_product()
    {
        $response = $this->get('/api/product');

        $response->assertStatus(200);
    }

    public function test_input_new_product_validation() {
        $response = $this->post('/api/product/add');
        $response->assertStatus(302);
    }

    public function test_input_new_product()
    {
        $data = [
            'name' => 'test',
            'description' => 'test',
            'price' => 100000,
            'qty' => 10
        ];
        $response = $this->post('/api/product/add', $data);
        $response->assertStatus(201);
    }

    public function test_update_product_validation()
    {
        $product = Product::first();

        if($product) {
            $data = [];
            $response = $this->put('/api/product/update/'.$product->id, $data);
        }
        $response->assertStatus(302);
    }

    public function test_update_product()
    {
        $product = Product::first();

        if($product) {
            $data = [
                'id' => $product->id,
                'name' => 'test edit',
                'description' => 'test edit xxx',
                'price' => 300000,
                'qty' => 10
            ];
            $response = $this->put('/api/product/update/'.$product->id, $data);
        }
        $response->assertStatus(200);
    }

    public function test_delete_product()
    {
        $product = Product::first();

        if($product) {
            $response = $this->delete('/api/product/'.$product->id);
        }
        $response->assertStatus(200);
    }
}
