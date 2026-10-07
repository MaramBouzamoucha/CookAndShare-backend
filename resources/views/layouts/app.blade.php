<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cook & Share</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .main-color { color: #CC5500; }
        .main-bg { background-color: #CC5500; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('recipes.indexBlade') }}" class="text-main-color font-bold text-xl">Cook & Share</a>
                    @auth
                        <a href="{{ route('recipes.indexBlade') }}" class="text-main-color font-semibold hover:underline">Toutes les recettes</a>

                        <a href="{{ route('recipes.myBlade') }}" class="text-main-color font-semibold hover:underline">Mes recettes</a>
                        <a href="{{ route('recipes.createBlade') }}" class="text-main-color font-semibold hover:underline">Créer une recette</a>
                    @endauth
                </div>
                <div class="flex space-x-4 items-center">
                    @auth
                        <a href="{{ route('profile') }}" class="text-main-color font-semibold hover:underline">Profil</a>
                        <form method="POST" action="{{ route('logoutBlade') }}">
                            @csrf
                            <button type="submit" class="main-bg text-white font-bold px-4 py-2 rounded hover:opacity-90">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('loginForm') }}" class="text-main-color font-semibold hover:underline">Connexion</a>
                        <a href="{{ route('registerForm') }}" class="text-main-color font-semibold hover:underline">Inscription</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-6 p-4 text-center text-main-color font-semibold">
        &copy; {{ date('Y') }} Cook & Share
    </footer>

</body>
</html>
