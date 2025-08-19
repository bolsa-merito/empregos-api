<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Studying;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudyingController extends Controller
{
    public function index()
    {
        return Studying::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAuthenticated(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem adicionar cursos.'], 403);
        }

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'institution_id' => 'required|exists:institutions,id',
            'beginning' => 'required|string',
            'end' => 'required|string',
            'semester' => 'required|string',
            'period' => 'required|string'
        ]);

        $studying = $user->student->studyings()->create($validated);

        return response()->json($studying, 201);
    }

    public function updateAuthenticated(Request $request, Studying $studying)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem atualizar cursos.'], 403);
        }

        // Garante que o registro pertence ao estudante autenticado
        if ($studying->student_id !== $user->student->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $validated = $request->validate([
            'course_id' => 'sometimes|required|exists:courses,id',
            'institution_id' => 'sometimes|required|exists:institutions,id',
            'beginning' => 'sometimes|required|string',
            'end' => 'sometimes|required|string',
            'semester' => 'sometimes|required|string',
            'period' => 'sometimes|required|string'
        ]);

        $studying->update($validated);

        return response()->json($studying);
    }

    public function destroyAuthenticated(Studying $studying)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem excluir cursos.'], 403);
        }

        if ($studying->student_id !== $user->student->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $studying->delete();

        return response()->json(['message' => 'Curso removido com sucesso.']);
    }
}
