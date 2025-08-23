<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Studying;
use Illuminate\Http\Request;

class StudyingController extends Controller
{
    public function index()
    {
        return Studying::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'institution_id' => 'required|exists:institutions,id',
            'beginning' => 'required|string',
            'end' => 'required|string',
            'semester' => 'required|string',
            'period' => 'required|string'
        ]);

        return Studying::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Studying $studying)
    {
        return $studying;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studying $studying)
    {
        $validated = $request->validate([
            'student_id' => 'sometimes',
            'course_id' => 'sometimes|required|exists:courses,id',
            'institution_id' => 'required|exists:institutions,id',
            'beginning' => 'sometimes|required|string',
            'end' => 'sometimes|required|string',
            'semester' => 'sometimes|required|string',
            'period' => 'sometimes|required|string'
        ]);

        unset($validated['student_id']);

        $studying->update($validated);
        return $studying;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studying $studying)
    {
        $studying->delete();

        return response()->json(['message' => 'Cursando deletado com sucesso']);
    }
}
