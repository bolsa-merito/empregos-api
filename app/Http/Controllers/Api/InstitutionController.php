<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index()
    {
        return Institution::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
        ]);

        return Institution::create($validated);
    }

    public function show(Institution $institution)
    {
        return $institution;
    }

    public function update(Request $request, Institution $institution)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
        ]);

        $institution->update($validated);
        return $institution;
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();
        return response()->json(null, 204);
    }
}