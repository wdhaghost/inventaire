<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_route(): void
    {
        $response = $this->get('/students');

        $response->assertStatus(200);
    }
    public function test_create_student(): void
    {

        $student=[
            'lastname'=>'Kujo',
            'firstname'=>'Jotaro',
            'mail'=>'jotaro@kujo.fr',
            'study'=>1
        ];

        $response = $this->post('/students',$student);

        $response->assertCreated();
    }
}