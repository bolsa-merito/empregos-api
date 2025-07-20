<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Student::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'nullable|date',
            'looking_for_internship' => 'boolean',
            'description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        return Student::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['studyings.course', 'studyings.institution', 'experience_and_project']);

        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'birth_date' => 'nullable|date',
            'looking_for_internship' => 'boolean',
            'description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string',
        ]);

        $student->update($validated);
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
