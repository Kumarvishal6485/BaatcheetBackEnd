<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser extends Controller
{
    public function createUser(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sub' => 'required|string',
            'picture' => 'nullable|string',
        ]);

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => Hash::make($request->sub),
                'image' => $request->picture,
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'user_id' => $user->id,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}