<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankcardTest extends TestCase
{
    /**
     * A basic get example.
     *
     * @return void
     */
    public function testBasicGet()
    {
        $response = $this->get('/bankcards');
        $response->assertStatus(200);
    }
}
