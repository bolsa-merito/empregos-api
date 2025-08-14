<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'course' => 'required|string',
            'institution' => 'required|string',
            'semester' => 'required|string',
            'period' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('profiles', 'public');
        }

        $profile = Profile::create($data);

        return response()->json($profile, 201);
    }

    public function show($id)
    {
        return Profile::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'course' => 'sometimes|string',
            'institution' => 'sometimes|string',
            'semester' => 'sometimes|string',
            'period' => 'sometimes|string',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($profile->image_path) {
                Storage::disk('public')->delete($profile->image_path);
            }
            $data['image_path'] = $request->file('image')->store('profiles', 'public');
        }

        $profile->update($data);

        return response()->json($profile);
    }


    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        if ($profile->image_path) {
            Storage::disk('public')->delete($profile->image_path);
        }
        $profile->delete();

        return response()->json(['message' => 'Perfil deletado com sucesso']);
    }
}
