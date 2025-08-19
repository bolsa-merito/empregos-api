<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Lista conexões do usuário autenticado (student ou company).
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            return $user->student->connections()->with('company')->get();
        }

        if ($user->role === 'company') {
            return $user->company->connections()->with('student')->get();
        }

        return response()->json(['message' => 'Tipo de usuário inválido.'], 403);
    }

    /**
     * Company envia convite de conexão para um estudante.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $user = Auth::user();

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Apenas empresas podem enviar convites.'], 403);
        }

        // cria conexão se não existir
        $connection = Connection::firstOrCreate(
            [
                'student_id' => $validated['student_id'],
                'company_id' => $user->company->id,
            ],
            [
                'status' => 'pending'
            ]
        );

        return response()->json($connection, 201);
    }

    /**
     * Student aceita ou recusa convite.
     */
    public function update(Request $request, Connection $connection)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $user = Auth::user();

        if ($user->role !== 'student' || $connection->student_id !== $user->student->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $connection->update(['status' => $validated['status']]);

        return response()->json($connection);
    }

    /**
     * Cancela/exclui a conexão (student ou company).
     */
    public function destroy(Connection $connection)
    {
        $user = Auth::user();

        if (
            ($user->role === 'student' && $connection->student_id === $user->student->id) ||
            ($user->role === 'company' && $connection->company_id === $user->company->id)
        ) {
            $connection->delete();
            return response()->json(['message' => 'Conexão removida com sucesso.']);
        }

        return response()->json(['message' => 'Não autorizado.'], 403);
    }
}