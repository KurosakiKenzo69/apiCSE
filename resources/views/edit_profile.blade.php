<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier le profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Modifier le profil</h1>
    <form action="{{ route('profiles.update', $profile->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ $profile->name }}" required>
        </div>
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ $profile->prenom }}" required>
        </div>
        <div>
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
                <option value="actif" {{ $profile->statut === 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ $profile->statut === 'inactif' ? 'selected' : '' }}>Inactif</option>
                <option value="en attente" {{ $profile->statut === 'en attente' ? 'selected' : '' }}>En attente</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Sauvegarder</button>
    </form>
</div>
</body>
</html>
