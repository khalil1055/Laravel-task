<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class alphaToIntTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBFG()
    {
        $response = $this->get('/api/alpha-to-int?string=BFG');
        $this->assertEquals( 1515,$response->json('result'));
    }

    public function testAAA()
    {
        $response = $this->get('/api/alpha-to-int?string=AAA');
        $this->assertEquals( 703,$response->json('result'));
    }

    public function testAZA()
    {
        $response = $this->get('/api/alpha-to-int?string=AZA');
        $this->assertEquals( 1353,$response->json('result'));
    }


}
