<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des profils</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">Liste des profils</h1>

    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="py-2">Nom</th>
            <th class="py-2">Prénom</th>
            <th class="py-2">Statut</th>
            <th class="py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
                <td class="border px-4 py-2">{{ $profile->nom }}</td>
                <td class="border px-4 py-2">{{ $profile->prenom }}</td>
                <td class="border px-4 py-2">{{ $profile->statut }}</td>
                <td class="border px-4 py-2 flex flex-row">
                    <form action="{{ route('profiles.edit', $profile->id) }}" method="GET">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-5">
                            Modifier
                        </button>
                    </form>
                    <form action="{{ route('profiles.delete', $profile->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Retour à la <a href="{{ route('accueil') }}" class="text-blue-500 hover:underline">page d'accueil</a></p>
</div>

</body>
</html>
