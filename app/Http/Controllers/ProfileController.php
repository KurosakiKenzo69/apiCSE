<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showCreateForm()
    {
        return view('create_profiles');
    }

    public function showListActif()
    {
        $profiles = Profile::where('statut', 'actif')->get();
        return view('list_profils', ['profiles' => $profiles]);
    }

    public function update(Request $request, $id)
    {
        // vérification de l'utilisateur s'il est admin ou non
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'sometimes|required|string|in:inactif,en attente,actif',
        ]);

        // Trouve le profil à modifier
        $profile = Profile::findOrFail($id);

        // Met à jour les données du profil
        $profile->update($validatedData);

        return response()->json(['message' => 'Profil mis à jour avec succès', 'profile' => $profile], 200);
    }

    public function create(Request $request)
    {
//        intérrogation de la requête

        if (auth()->check() && auth()->user()->role === 'admin') {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'statut' => 'required|in:inactif,en attente,actif',
            ]);
        }

        if ($request->hasFile('image')) {
            $path = Storage::putFile('images', $request->file('image'));
        } else {
            $path = null;
        }

//        création du profil
        $profile = Profile::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'image' => $path,
            'statut' => $request->statut,
//            clé étrangère de la table users pour lier le profil à l'utilisateur
            'user_id' => Auth::id(),
        ]);


        return redirect()->back()->with('message',"Profil crée avec succès");

    }

}
