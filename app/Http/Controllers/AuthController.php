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
            'role' => 'required|string|in:user,admin',
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
            'role' => $request->role,
        ]);

        event(new Registered($user));

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json(['message' =>
            'Utilisateur enregistré !',
            'token' => $token,
        ], 201);
    }

    // connecter un utilisateur
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Si la connexion réussit, rediriger vers la page d'accueil
            return redirect()->route('accueil')->with('success', 'Connexion réussie !');
        } else {
            // Si la connexion échoue, retourner une erreur avec un message
            return redirect()->back()->withErrors([
                'email' => 'Les identifiants sont incorrects. Veuillez réessayer.',
            ])->withInput($request->only('email'));
        }

    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    // déconnecter un utilisateur
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        return redirect()->route('login')->with('success', 'Déconnexion réussie !');
    }

}
