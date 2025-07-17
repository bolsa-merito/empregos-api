<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'looking_for_internship' => 'boolean',
            'description' => 'nullable|string',
            'contact_email' => 'nullable|string|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Criar o student
        $student = Student::create($request->all());

        // Carregar o relacionamento com user
        $student->load('user');

        return response()->json([
            'message' => 'Estudante registrado com sucesso!',
            'student' => $student
        ], 201);
    }
}