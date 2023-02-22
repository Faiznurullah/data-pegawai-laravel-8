<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class NouserCanseeDataTest extends TestCase
{
    /** @test */
    public function Nouser_Can_see_Data()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
    }
}
