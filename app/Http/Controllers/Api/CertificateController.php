<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Certificate::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAuthenticated(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'course_load' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem adicionar certificados.'], 403);
        }

        $student = $user->student;

        if (!$student) {
            return response()->json(['message' => 'Perfil de estudante não encontrado.'], 404);
        }

        // Criar registro vinculado ao estudante autenticado
        $certificate = $student->certificates()->create($validated);

        return response()->json($certificate, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAuthenticated(Certificate $certificate)
    {
        return $certificate;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAuthenticated(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'institution' => 'sometimes|required|string|max:255',
            'course_name' => 'sometimes|required|string|max:255',
            'course_load' => 'sometimes|required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem atualizar certificados.'], 403);
        }

        if (!$certificate->student || $user->id !== $certificate->student->user_id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $certificate->update($validated);

        return response()->json($certificate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAuthenticated($id)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Apenas estudantes podem excluir certificados.'], 403);
        }

        $certificate = Certificate::whereHas('student', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        $certificate->delete();

        return response()->json(['message' => 'Certificado excluído com sucesso.'], 200);
    }
}
