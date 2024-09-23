<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Profils</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Liste des profils actifs</h1>

    @if($profiles->isEmpty())
        <p>Aucun profil actif trouvé.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b text-left">Nom</th>
                <th class="py-2 px-4 border-b text-left">Prénom</th>
                <th class="py-2 px-4 border-b text-left">Statut</th>
            </tr>
            </thead>
            <tbody>
            @foreach($profiles as $profile)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $profile->nom }}</td>
                    <td class="py-2 px-4 border-b">{{ $profile->prenom }}</td>
                    <td class="py-2 px-4 border-b">{{ $profile->statut }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <p class="mt-4"><a href="{{ route('accueil') }}" class="text-blue-500 hover:underline">Retour à l'accueil</a></p>
</div>
</body>
</html>
