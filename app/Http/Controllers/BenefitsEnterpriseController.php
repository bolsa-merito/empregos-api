<?php

namespace App\Http\Controllers;

use App\Models\BenefitsEnterprise;
use Illuminate\Http\Request;

class BenefitsEnterpriseController extends Controller
{
    public function index()
    {
        return BenefitsEnterprise::all();
    }

    public function show($id)
    {
        return BenefitsEnterprise::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'benefits' => 'required|array',
            'benefits.*.title' => 'required|string',
            'benefits.*.description' => 'required|string|min:5',
        ]);

        $created = [];
        foreach ($validated['benefits'] as $benefit) {
            $created[] = BenefitsEnterprise::create($benefit);
        }

        return response()->json([
            'message' => 'Benefícios (Enterprise) salvos com sucesso',
            'data' => $created
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $benefit = BenefitsEnterprise::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string|min:5',
        ]);

        $benefit->update($validated);

        return response()->json([
            'message' => 'Benefício (Enterprise) atualizado com sucesso',
            'data' => $benefit
        ]);
    }

    public function destroy($id)
    {
        $benefit = BenefitsEnterprise::findOrFail($id);
        $benefit->delete();

        return response()->json(['message' => 'Benefício (Enterprise) deletado com sucesso']);
    }
}
