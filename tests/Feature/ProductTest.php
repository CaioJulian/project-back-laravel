<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * List products test.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/products');

        $data = json_decode($response->content());
        var_export($data);

        $response->assertStatus(200);
    }


    /**
     * Create product test.
     *
     * @return void
     */
    public function testStore()
    {
        $body = [
            'title' => 'Brown eggs',
            'type' => 'dairy',
            'description' => 'Raw organic brown eggs in a basket',
            'price' => 28.1,
            'rating' => 4
        ];

        $response = $this->post('/api/products', $body);

        $data = json_decode($response->content());
        var_export($data);

        $response->assertStatus(201);
    }

    /**
     * View product test.
     *
     * @return void
     */
    public function testShow()
    {
        $productId = 1;

        $response = $this->get('/api/products/' . $productId);

        $data = json_decode($response->content());
        var_export($data);

        $response->assertStatus(200);

        return $data->product->id;
    }

    /**
     * Update product test.
     *
     * @return void
     */
    public function testUpdate()
    {
        $productId = $this->testShow();

        $body = [
            'title' => 'Sweet fresh stawberry',
            'type' => 'fruit',
            'description' => 'Sweet fresh stawberry on the wooden table',
            'price' => 29.45,
            'rating' => 3
        ];

        $response = $this->put('/api/products/' . $productId, $body);

        $data = json_decode($response->content());
        var_export($data);

        $response->assertStatus(201);
    }

    /**
     * Delete product test.
     *
     * @return void
     */
    public function testDelete()
    {
        $productId = $this->testShow();

        $response = $this->delete('/api/products/' . $productId);

        $data = json_decode($response->content());
        var_export($data);

        $response->assertStatus(201);
    }
}
