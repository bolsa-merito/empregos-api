<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Certificate::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'institution' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'course_load' => 'required|string|max:255',
        ]);

        return Certificate::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return $certificate;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'institution' => 'sometimes|required|string|max:255',
            'course_name' => 'sometimes|required|string|max:255',
            'course_load' => 'sometimes|required|string|max:255',
        ]);

        $certificate->update($validated);
        return $certificate;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return response()->json(null, 204);
    }
}
