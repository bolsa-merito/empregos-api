<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BenefitsTemplate;
use Illuminate\Http\Request;

class BenefitsTemplateController extends Controller
{
    // Listar todos
    public function index()
    {
        return response()->json(BenefitsTemplate::all());
    }

    // Criar novo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $benefit = BenefitsTemplate::create($validated);

        return response()->json($benefit, 201);
    }

    // Mostrar por ID
    public function show($id)
    {
        $benefit = BenefitsTemplate::findOrFail($id);
        return response()->json($benefit);
    }

    // Atualizar
    public function update(Request $request, $id)
    {
        $benefit = BenefitsTemplate::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $benefit->update($validated);

        return response()->json($benefit);
    }

    // Deletar
    public function destroy($id)
    {
        $benefit = BenefitsTemplate::findOrFail($id);
        $benefit->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
