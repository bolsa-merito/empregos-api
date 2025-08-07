<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        return Formation::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'institution' => 'required|string|max:255',
        ]);

        $formation = Formation::create($data);

        return response()->json($formation, 201);
    }

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return response()->json($formation);
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $data = $request->validate([
            'course' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'institution' => 'sometimes|string|max:255',
        ]);

        $formation->update($data);

        return response()->json($formation);
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return response()->json(['message' => 'Formação excluída com sucesso']);
    }
}
