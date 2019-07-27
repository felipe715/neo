<?php

namespace Tests\Feature;

use App\Utils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UtilsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testInvalidCpf(){

        $a = Utils::validateCpf('1000000000');
        $this->assertEquals(0, $a);
    }

    public function testValidCpf(){

        $a = Utils::validateCpf('08445764926');
        $this->assertEquals(1, $a);
    }
}
