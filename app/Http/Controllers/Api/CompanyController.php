<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        // exige autenticação por token
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        // Lista todas as empresas com paginação
        return Company::with('address')->paginate(10);
    }

    /**
     * Retorna os dados da empresa autenticada
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Apenas empresas podem acessar esse recurso.'], 403);
        }

        $company = $user->company;

        if (!$company) {
            return response()->json(['message' => 'Perfil de empresa não encontrado.'], 404);
        }

        return response()->json($company);
    }

    /**
     * Cria o perfil da empresa vinculando ao usuário autenticado
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Apenas empresas podem criar perfis.'], 403);
        }

        if ($user->company) {
            return response()->json(['message' => 'Empresa já cadastrada.'], 400);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            // campos do endereço
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.neighborhood' => 'required|string',
            'address.street' => 'required|string',
            'address.number' => 'required|string',
        ]);

        // cria o endereço primeiro
        $address = \App\Models\Address::create($validated['address']);

        // cria a empresa vinculado ao usuário e ao endereço
        $company = \App\Models\Company::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'address_id' => $address->id,
        ]);

        return response()->json($company, 201);
    }

    /**
     * Atualiza o perfil da empresa
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Apenas empresas podem atualizar perfis.'], 403);
        }

        $company = $user->company;

        if (!$company) {
            return response()->json(['message' => 'Perfil de empresa não encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'address_id' => 'nullable|exists:addresses,id',
        ]);

        $company->update($validated);

        return response()->json($company);
    }

    /**
     * Remove o perfil da empresa
     */
    public function destroy()
    {
        $user = Auth::user();

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Apenas empresas podem excluir perfis.'], 403);
        }

        $company = $user->company;

        if (!$company) {
            return response()->json(['message' => 'Perfil de empresa não encontrado.'], 404);
        }

        $company->delete();

        return response()->json(['message' => 'Perfil de empresa removido com sucesso.']);
    }
}
