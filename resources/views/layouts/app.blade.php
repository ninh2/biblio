<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="@yield('body-class', '')">
    

    <nav>
        <ul>
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
            @if(session('user'))
                <li><a href="{{ route('reservations.index') }}"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                <li><a href="{{ route('ouvrages') }}"><i class="fas fa-book"></i> Ouvrages</a></li>
                @if(session('user')['role'] === 'gestionnaire')
                    <li><a href="{{ route('auteurs.index') }}"><i class="fas fa-user-pen"></i> Auteurs</a></li>
                    <li><a href="{{ route('users.list') }}"><i class="fas fa-users"></i> Utilisateurs</a></li>
                    <li><a href="{{ route('editeurs.index') }}"><i class="fas fa-building"></i> Editeurs</a></li>
                @endif
                <li class="logout">
                    <a href="#" class="nav-link" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                        @csrf
                    </form>
                </li>
            @else
                <li><a href="{{ route('Connexion') }}"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
            @endif
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <div class="footer-text">
        @if(session('user'))
            <p>Connecté en tant que {{ session('user')['nom']}} {{ session('user')['prenom']}}</p>
            <br>
        @endif
        <p>© 2025 - Mon Site Laravel</p>
    </div>

    <header></header>
    <footer></footer>
</body>
</html>