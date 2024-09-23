<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h1 class="text-2xl font-bold text-center mb-6">Page d'accueil</h1>

    <div class="flex flex-col space-y-4">
        <a href="{{ route('profiles.create.form') }}"
           class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600 text-center">
            Créer un profil
        </a>

        <a href="{{route('profiles.list')}}"
           class="w-full bg-green-500 text-white font-bold py-2 rounded hover:bg-green-600 text-center">
            Voir les profils actifs
        </a>

        <a href="{{ route('profiles.list.edit') }}"
           class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600 text-center">
            Modifier un profil
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-500 text-white font-bold py-2 rounded hover:bg-red-600">
                Déconnexion
            </button>
        </form>

    </div>
</div>
</body>
</html>
