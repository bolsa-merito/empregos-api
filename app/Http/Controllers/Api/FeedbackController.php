<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Feedback::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        return Feedback::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return $feedback;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'comment' => 'sometimes|required|string'
        ]);

        $feedback->update($validated);
        return $feedback;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return response()->json(null, 204);
    }
}
