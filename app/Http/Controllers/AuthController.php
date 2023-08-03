<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function signup(Request $request){

        $validated_input = $request->validate([
            'username' => 'required | min:3',
            'email' => 'required | unique:users',
            'password' => 'required | min:6',
        ]);

        try {
            User::create($validated_input);
    
            // return redirect()->route('signup')->with('message', 'Signup succcessful.');
            return response()->json(['message' => 'Signup successful']);
        } catch (Exception $e) {
            // return redirect()->route('signup')->withErrors();
            return response()->json(['message' => 'Signup failed']);
        }
    }

    public function login(Request $request){
        $user_credentials = $request->only(['username', 'password']);

        if (Auth::attempt($user_credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['message' => 'success', 'token' => $token, 'id' => $user->id], 200);
        }else{
            return response()->json(['message' => 'fail'], 401);
        }
    }

    public function logout(){

    }

}
