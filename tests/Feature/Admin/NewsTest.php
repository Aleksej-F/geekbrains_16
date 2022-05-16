<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckNewsIndex(): void
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

	public function testCheckNewsCreate()
	{
		$response = $this->get(route('admin.news.create'));

		$response->assertStatus(200);
	}

	public function testCheckNewsStore()
	{
		$data = [
			'title' => 'Some title',
			'author' => 'Some author',
			'status' => 'ACTIVE',
			'description' => 'Some description'
		];
		$response = $this->post(route('admin.news.store'), $data);
		$response->assertJson($data)->assertStatus(201);
	}
}
