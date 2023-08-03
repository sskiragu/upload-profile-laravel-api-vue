<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $encodedFile = $request->input('file');
    
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/profiles', $filename);
    
                
                $imageUrl = asset('storage/profiles/' . $filename);
    
                Profile::create(['id' => $user->id,'photo' => $imageUrl]);
    
                return response()->json(['message' => 'Image uploaded successfully', 'image_url' => $imageUrl, 'user' => $user->id]);
            }
    
            return response()->json(['message' => 'Failed to upload image'], 500);
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Assuming the $id is the user ID, you can fetch the profile associated with that user.
        $profile = Profile::where('id', $id)->first();

        // If the profile exists and belongs to the authenticated user, return the data.
        if ($profile && $profile->id === $user->id) {
            return response()->json(['message' => 'Profile retrieved successfully', 'profile' => $profile->photo]);
        }

        // If the profile does not exist or does not belong to the authenticated user, return an error response.
        return response()->json(['message' => 'Profile not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $user = Auth::user();
    $profile = Profile::where('id', $user->id)->first();
    
    try {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $encodedFile = $request->input('file');

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profiles', $filename);

            $imageUrl = asset('storage/profiles/' . $filename);

            if ($profile) {
                $profile->update(['photo' => $imageUrl]);
            } else {
                Profile::create(['id' => $user->id, 'photo' => $imageUrl]);
            }

            return response()->json(['message' => 'Image uploaded successfully', 'image_url' => $imageUrl]);
        }
        return response()->json(['message' => 'No file uploaded'], 400);
    } catch (\Throwable $th) {
        return response()->json(['message' => $th->getMessage(), 'id' => $user->id, 'user_id' => $profile], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
