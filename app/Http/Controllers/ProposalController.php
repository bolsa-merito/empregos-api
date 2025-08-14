<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        return Proposal::all();
    }

    public function show($id)
    {
        return Proposal::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'salary' => 'required|numeric',
            'hours' => 'required|integer|min:1|max:48',
            'contractType' => 'required|string',
        ]);

        $proposal = Proposal::create([
            'salary' => $validated['salary'],
            'hours' => $validated['hours'],
            'contract_type' => $validated['contractType'],
        ]);

        return response()->json(['message' => 'Proposta salva com sucesso', 'data' => $proposal], 201);
    }

    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $validated = $request->validate([
            'salary' => 'required|numeric',
            'hours' => 'required|integer|min:1|max:48',
            'contractType' => 'required|string',
        ]);

        $proposal->update([
            'salary' => $validated['salary'],
            'hours' => $validated['hours'],
            'contract_type' => $validated['contractType'],
        ]);

        return response()->json(['message' => 'Proposta atualizada com sucesso', 'data' => $proposal]);
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return response()->json(['message' => 'Proposta deletada com sucesso']);
    }
}
