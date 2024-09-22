<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
//    enregistrement d'un utilisateur
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

//        retour des erreurs de validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

//        création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'Utilisateur enregistré !'], 201);
    }

    // connecter un utilisateur
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Identifiants incorrects, veuillez réessayer'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    // déconnecter un utilisateur
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}
