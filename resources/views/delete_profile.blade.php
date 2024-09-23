<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Supprimer le profil</h1>
    <form action="{{ route('profiles.delete', $profile->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <p>Voulez-vous vraiment supprimer le profil de {{ $profile->nom }} {{ $profile->prenom }} ?</p>
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
    </form>
</div>
</body>
</html>
