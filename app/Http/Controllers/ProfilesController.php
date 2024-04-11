<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    // Get all profiles
    public function getAllProfiles()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    // Add a profile
    public function createProfile(Request $request)
    {
        $profile = Profile::create($request->all());
        return response()->json($profile, 201);
    }

    // Update a profile

    // Delete a profile
}
