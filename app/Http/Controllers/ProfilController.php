<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function create()
    {
        return view('profil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'statut' => 'required|in:inactif,en attente,actif',
        ]);

        $profilData = $request->only('prenom', 'nom', 'statut');

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $profilData['image'] = $request->file('image')->store('profil_images', 'public');
        }

        Profil::create([
            'user_id' => Auth::id(),
            'prenom' => $profilData['prenom'],
            'nom' => $profilData['nom'],
            'image' => $profilData['image'] ?? null,
            'statut' => $profilData['statut'],
        ]);

        return redirect()->route('profil.show');
    }

    public function show()
    {
        $profil = Auth::user()->profil;

        return view('profil.show', compact('profil'));
    }
}
