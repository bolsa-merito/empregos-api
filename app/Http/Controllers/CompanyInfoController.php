<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index()
    {
        return CompanyInfo::all();
    }

    public function show($id)
    {
        return CompanyInfo::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'field' => 'required|string',
            'description' => 'required|string',
            'cep' => 'required|string|min:8',
            'state' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
        ]);

        $company = CompanyInfo::create($validated);

        return response()->json([
            'message' => 'Informações da empresa salvas com sucesso',
            'data' => $company
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $company = CompanyInfo::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'field' => 'required|string',
            'description' => 'required|string',
            'cep' => 'required|string|min:8',
            'state' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
        ]);

        $company->update($validated);

        return response()->json([
            'message' => 'Informações da empresa atualizadas com sucesso',
            'data' => $company
        ]);
    }

    public function destroy($id)
    {
        $company = CompanyInfo::findOrFail($id);
        $company->delete();

        return response()->json(['message' => 'Informações da empresa deletadas com sucesso']);
    }
}
