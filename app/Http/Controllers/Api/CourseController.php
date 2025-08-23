<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'area_id' => 'required|exists:areas,id',
        ]);

        return Course::create($validated);
    }

    public function show(Course $course)
    {
        $course->load('studyings.student');

        $students = $course->studyings->map(function ($studying) {
            return $studying->student;
        });

        return response()->json([
            'course' => $course->only(['id', 'name', 'area_id']),
            'students' => $students,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'area_id' => 'sometimes|required|exists:areas,id',
        ]);

        $course->update($validated);
        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}
