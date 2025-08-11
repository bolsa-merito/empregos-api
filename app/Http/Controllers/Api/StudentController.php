<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $student->load(['studyings.course', 'studyings.institution', 'experience_and_project', 'certificates']);

        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAuthenticated(Request $request)
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

        // Pega o usuário autenticado pelo token
        $user = Auth::user();

        // Garante que ele seja realmente um estudante
        if ($user->role !== 'student') {
            return response()->json(['error' => 'Apenas estudantes podem atualizar esse perfil.'], 403);
        }

        // Busca o estudante vinculado ao usuário
        $student = $user->student; // relação definida no model User

        if (!$student) {
            return response()->json(['error' => 'Perfil de estudante não encontrado.'], 404);
        }

        $student->update($validated);

        return response()->json($student);
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
