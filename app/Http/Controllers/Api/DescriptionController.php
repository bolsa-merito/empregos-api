<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Description;

class DescriptionController extends Controller
{
    public function index()
    {
        return Description::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string|min:10|max:500',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\(\d{2}\) \d{5}-\d{4}$/'],
        ]);

        $desc = Description::create($data);

        return response()->json($desc, 201);
    }

    public function show($id)
    {
        return Description::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $description = Description::findOrFail($id);

        $data = $request->validate([
            'description' => 'sometimes|string|min:10|max:500',
            'email' => 'sometimes|email',
            'phone' => ['sometimes', 'regex:/^\(\d{2}\) \d{5}-\d{4}$/'],
        ]);

        $description->update($data);

        return response()->json($description);
    }

    public function destroy($id)
    {
        Description::findOrFail($id)->delete();

        return response()->json(['message' => 'Descrição deletada com sucesso']);
    }
}