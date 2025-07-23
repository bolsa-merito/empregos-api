<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'user_id' => 'required|exists:users,id|unique:companies,user_id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        return Company::create($validated);
    }


    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load(['address']);
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'address_id' => 'sometimes|required|exists:addresses,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
        ]);

        $company->update($validated);
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(null, 204);
    }
}