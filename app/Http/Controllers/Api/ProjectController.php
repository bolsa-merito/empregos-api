<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projects' => 'required|array|min:1',
            'projects.*.title' => 'required|string|max:255',
            'projects.*.description' => 'required|string|min:10|max:500',
            'projects.*.skills' => 'required|string',
        ]);

        $created = [];
        foreach ($data['projects'] as $projectData) {
            $created[] = Project::create($projectData);
        }

        return response()->json($created, 201);
    }

    public function show($id)
    {
        return Project::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|min:10|max:500',
            'skills' => 'sometimes|string',
        ]);

        $project->update($data);

        return response()->json($project);
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Projeto deletado com sucesso']);
    }
}
