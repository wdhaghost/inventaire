<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // List all resources
    }

    public function create()
    {
        // Show the create resource form
    }

    public function store(Request $request)
    {
        // Store a new resource in the database
        $student = new Student;
        $student->lastname = $request->lastname;
        $student->firstname = $request->firstname;
        $student->mail = $request->mail;
        $student->study = $request->study;
    
        $student->save();

        return redirect()->route('students.index', status: 201);
    }

    public function show($id)
    {
        // Display a specific resource
    }

    public function edit($id)
    {
        // Show the edit resource form
    }

    public function update(Request $request, $id)
    {
        // Update a specific resource in the database
    }

    public function destroy($id)
    {
        // Delete a specific resource
    }
}
