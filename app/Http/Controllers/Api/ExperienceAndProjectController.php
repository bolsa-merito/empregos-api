<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExperienceAndProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function storeAuthenticated(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem criar experiências.'], 403);
        }

        $student = $user->student;

        if (!$student) {
            return response()->json(['message' => 'Perfil de estudante não encontrado.'], 404);
        }

        // Criar registro vinculado ao estudante autenticado
        $experience = $student->experience_and_project()->create($validated);

        return response()->json($experience, 201);
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
    public function updateAuthenticated(Request $request, ExperienceAndProject $experience)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
        ]);

        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem atualizar experiências.'], 403);
        }

        if (!$experience->student || $user->id !== $experience->student->user_id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $experience->update($validated);

        return response()->json($experience);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAuthenticated(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem excluir experiências.'], 403);
        }

        $experience = ExperienceAndProject::whereHas('student', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        $experience->delete();

        return response()->json(['message' => 'Experiência excluída com sucesso.'], 200);
    }
}
