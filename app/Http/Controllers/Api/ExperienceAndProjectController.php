<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExperienceAndProject;
use Illuminate\Http\Request;

class ExperienceAndProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExperienceAndProject::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'student_id' => 'required|exists:students,id',
        ]);

        return ExperienceAndProject::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExperienceAndProject $project_and_experience)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'student_id' => 'sometimes'
        ]);

        unset($validated['student_id']);
        $project_and_experience->update($validated);
        return $project_and_experience;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExperienceAndProject $project_and_experience)
    {
        $project_and_experience->delete();
        return response()->json(['message' => 'Experiencia deletada'], 204);
    }
}
