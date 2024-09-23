<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Profils</title>
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
            @if (auth()->check() && auth()->user()->role === 'admin')
                <th class="py-2">Statut</th>
            @endif
            <th class="py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
                <td class="border px-4 py-2">{{ $profile->nom }}</td>
                <td class="border px-4 py-2">{{ $profile->prenom }}</td>
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <td class="border px-4 py-2">{{ $profile->statut }}</td>
                @endif
                <td class="border px-4 py-2">
                    <form action="{{ route('profiles.edit', $profile->id) }}" method="GET">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Modifier
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Retour à la <a href="{{ route('accueil') }}" class="text-blue-500 hover:underline">page d'accueil</a> </p>
</div>

</body>
</html>
