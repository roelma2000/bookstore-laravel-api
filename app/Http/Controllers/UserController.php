<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Get all users
    public function getAllUsers()
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $users = User::all();
        return response()->json($users);
    }

    // Add a user
    public function createUser(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'sometimes|string' // role is optionally provided
        ]);

        if ($validator ->fails()) {
            return response()->json(['errors' => $validator ->errors()], 422);
        }

         // Get the validated data
        $validatedData = $validator->validated();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        //To securely hash the password before storing it in the database.
        $user->password = Hash::make($validatedData['password']);
        $user->email_verified_at = now(); // Set this based on your verification logic
        $user->remember_token = Str::random(10); // Generate a random token

        // Retrieve the secret admin code from the .env file
        // Default Value: The env function takes a second parameter as a default value.
        // This ensures that if the ADMIN_SECRET_CODE is not set in the .env file,
        // the application will use the default value ('defaultCode' in this case).
        $secretAdminCode = env('ADMIN_SECRET_CODE', 'defaultCode');

        // Set the role based on a secret code or other criteria
        $user->role = ($validatedData['role'] ===  $secretAdminCode) ? User::ADMIN_ROLE : 'customer';

        $user->save();

         return response()->json(['message' => 'User Access successfully created.'], 201);
    }

    // Change password
    public function changePassword(Request $request)
    {


        return response()->json(['message' => 'Password changed successfully']);
    }

    // Get a user by ID
    public function getUserById($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    // Update a user
    public function updateUserId(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // other fields you want to allow for update
        ]);

        $user->update($validatedData);
        return response()->json($user);
    }

    // Delete a user
    public function deleteUserId($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
