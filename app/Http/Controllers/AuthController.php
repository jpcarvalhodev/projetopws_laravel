<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        $passwordHashed = bcrypt($request->password);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $passwordHashed;

        $user->save();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $isPasswordValid = Hash::check($request->password, $user->password);

        if (!$user || !$isPasswordValid) {
            return response()->json([
                "message" => "Credenciais inválidas",
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ]);
    }
}
