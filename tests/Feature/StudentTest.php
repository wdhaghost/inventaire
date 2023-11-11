<?php

namespace Tests\Feature;

use App\Models\Student;
use Database\Factories\StudentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_route(): void
    {
        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertViewIs('students.index');
    }
    public function test_index_nonExistant_route(): void
    {
        $response = $this->get('/studentszefezf');

        $response->assertStatus(404);
    }
    public function test_show_route(): void
    {
        $student =
            $response = $this->get('/students/{$student->id}');

        $response->assertStatus(200);
        $response->assertViewIs('students.show');
    }
    public function test_show_non_existant_route(): void
    {
        $response = $this->get('/student/999');
        $response->assertStatus(404);
    }
    public function test_create_route(): void
    {
        $response = $this->get('/students/create');

        $response->assertStatus(200);
        $response->assertViewIs('students.create');
    }

    public function test_edit_route(): void
    {
        $response = $this->get('students/{id}/edit');
        $response->assertStatus(200);
        $response->assertViewIs('students.edit');
    }
    public function test_store_route(): void
    {

        $student = [
            'lastname' => 'Kujo',
            'firstname' => 'Jotaro',
            'mail' => 'jotaro@kujo.fr',
            'study' => 1
        ];

        $response = $this->post('/students', $student);

        $response->assertStatus(302);
        $this->assertDatabaseHas('students', $student);
    }


    public function test_store_invalid_data_route(): void
    {

        $student = [
            'lastname' => '',
            'firstname' => 'Jotaro',
            'mail' => 'jotaro.fr',
            'study' => 7
        ];

        $response = $this->post('/students', $student);
        $response->assertSessionHasErrors(['lastname', 'mail', 'study']);
    }


    public function test_update_route(): void
    {
        $student = Student::factory()->create();

        $updatedStudent = [
            'lastname' => 'NewLastName',
            'firstname' => 'NewFirstName',
            'mail' => 'newemail@example.com',
            'study' => 2
        ];

        $response = $this->put("/students/{$student->id}", $updatedStudent);

        $response->assertStatus(302);
        $this->assertDatabaseHas('students', $updatedStudent);
    }



    public function test_update_invalid_data_route(): void
    {
        $student = Student::factory()->create();

        $updatedStudent = [
            'lastname' => '',
            'firstname' => 'NewFirstName',
            'mail' => 'newemailexample.com',
            'study' => 7
        ];

        $response = $this->put("/students/{$student->id}", $updatedStudent);

        $response->assertSessionHasErrors(['lastname', 'mail', 'study']);
    }
    public function test_update_nonExisting_student_route(): void
    {
        $updatedStudent = [
            'lastname' => 'NewLastName',
            'firstname' => 'NewFirstName',
            'mail' => 'adozakd@test.com',
            'study' => 2
            
        ];
        $response = $this->put("/students/600", $updatedStudent);

        $response->assertStatus(404);
    }

    public function test_delete_route(): void
    {
        $student = Student::factory()->create();

        $response = $this->delete("/students/{$student->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('students',['id' => $student->id]);
    }

    public function test_delete_nonExisting_student_route(): void
    {

        $response = $this->delete("/students/600");

        $response->assertStatus(404);
        
    }

}
    

