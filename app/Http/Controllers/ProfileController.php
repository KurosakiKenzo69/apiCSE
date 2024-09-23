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

    public function listForEdit()
    {
        $profiles = Profile::all();
        return view('list_edit', compact('profiles'));
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('edit_profile', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        // Vérifier que l'utilisateur est administrateur
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Valider les données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'statut' => 'required|in:inactif,en attente,actif',
        ]);

        // Trouver le profil et le mettre à jour
        $profile = Profile::findOrFail($id);
        $profile->update($validated);

        return redirect()->route('profiles.list', $id)->with('success', 'Profil mis à jour avec succès.');
    }

    // supprimer un profil
    public function destroy($id)
    {
        // Vérifier que l'utilisateur est administrateur
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Trouver et supprimer le profil
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('accueil')->with('success', 'Profil supprimé avec succès.');
    }

}
