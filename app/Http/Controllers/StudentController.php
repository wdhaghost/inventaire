<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index()
    {
        // List all resources
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        // Show the create resource form
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Store a new resource in the database
        try {

            $request->validate([
                'lastname' => 'required|string|min:3',
                'firstname' => 'required|string|min:3',
                'mail' => 'required|email|unique:students',
                'study' => 'required|integer|min:1|max:10'

            ]);
            $student = new Student;
            $student->lastname = $request->lastname;
            $student->firstname = $request->firstname;
            $student->mail = $request->mail;
            $student->study = $request->study;

            $student->save();

            return redirect()->route('students.index');
        } catch (ValidationException $e) {
            return redirect()->route('students.create')->withErrors($e->validator->errors())->withInput();
        }
    }

    public function show($id)
    {
        // Display a specific resource
        $student = Student::find($id);
        
        return view('students.show', ['student' => $student]);
    }

    public function edit($id)
    {
        // Show the edit resource form
        $student = Student::find($id);
        if (!$student) {
            abort(404, 'Etudiant non existant.');
        }
        return view('students.edit', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                abort(404, 'Etudiant non existant.');
            
            }
            $request->validate([
                'lastname' => 'required|string|min:3',
                'firstname' => 'required|string|min:3',
                'mail' => 'required|email|unique:students',
                'study' => 'required|integer|min:1|max:5'

            ]);
            $student->lastname = $request->lastname;
            $student->firstname = $request->firstname;
            $student->mail = $request->mail;
            $student->study = $request->study;

            $student->update();
            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        } catch (ValidationException $e) {
            return redirect()->route('students.create')->withErrors($e->validator->errors())->withInput();
        }

        // Update a specific resource in the database

    }

    public function destroy($id)
    {
        // Delete a specific resource from the database
        $student = Student::find($id);
        if (!$student) {
            abort(404, 'Etudiant non existant.');
        
        }
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
