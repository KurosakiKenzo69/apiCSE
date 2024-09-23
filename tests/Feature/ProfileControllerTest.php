<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_profile()
    {
        // Crée un utilisateur et authentifie-le
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->actingAs($user); // S'assurer que l'utilisateur est authentifié

        // Effectue la requête pour créer le profil
        $response = $this->postJson('/api/profiles', [
            'nom' => 'Doe',
            'prenom' => 'John',
            'statut' => 'actif',
//            'password' => 'password',
            'image' => null,
        ]);

        // Vérifie que la réponse a le statut 201
        $response->assertStatus(201);
    }


    public function test_create_profile_validation()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->postJson('/api/profiles', [
            'nom' => '',
            'prenom' => '',
            'image' => '',
            'statut' => 'invalide',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['nom', 'prenom', 'statut']);
    }
}
