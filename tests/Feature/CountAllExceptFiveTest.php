<?php

namespace Tests\Feature;

use Tests\TestCase;

class CountAllExceptFiveTest extends TestCase
{

    public function test1_9()
    {
        $response = $this->get('/api/count-all-except-five?start=1&end=9');
        $this->assertEquals( 8,$response->json('result'));
    }

    public function test4_17()
    {
        $response = $this->get('/api/count-all-except-five?start=4&end=17');
        $this->assertEquals( 12,$response->json('result'));
    }


    public function test40_66()
    {
        $response = $this->get('/api/count-all-except-five?start=40&end=66');
        $this->assertEquals( 15,$response->json('result'));
    }

    public function test1_104505()
    {
        $response = $this->get('/api/count-all-except-five?start=1&end=104505');
        $this->assertEquals( 62369,$response->json('result'));
    }

    public function test521_1045505()
    {
        $response = $this->get('/api/count-all-except-five?start=521&end=1045505');
        $this->assertEquals( 560925,$response->json('result'));
    }


    public function test5217_15505()
    {
        $response = $this->get('/api/count-all-except-five?start=5217&end=15505');
        $this->assertEquals( 6561,$response->json('result'));
    }


    public function test249_479632()
    {
        $response = $this->get('/api/count-all-except-five?start=249&end=479632');
        $this->assertEquals( 281623,$response->json('result'));
    }


}
