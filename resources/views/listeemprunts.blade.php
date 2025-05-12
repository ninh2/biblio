<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'emprunt</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Mon Site Laravel</h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('reservations.index') }}">Réservations</a></li>
            </ul>
        </nav>
    </header>
    
        <table>
            <tr>
                <th>id</th>
                <th>ouvrage</th>
                <th>utilisateur</th>
                <th>date</th>
                <th>date retour prévue</th>
                <th>date retour réel</th>
                <th>Actions</th> <!-- Ajout d'une colonne pour les actions -->
            </tr>
            @foreach($emprunts as $unemprunt)
            <tr>
                <td>{{$unemprunt->id_emprunt}}</td>
                <td>{{$unemprunt->id_ouvrage}}</td>
                <td>{{$unemprunt->id_utilisateur}}</td>
                <td>{{$unemprunt->date_emprunt}}</td>
                <td>{{$unemprunt->date_retour_prevue}}</td>
                <td>{{$unemprunt->date_retour_reel}}</td>
                
                <td>
                <form action="/update/{{ $unemprunt['id_emprunt'] }}" method="GET">
                    <button type="submit">MAJ</button>
                </form>
                
                <form method="post" action="/suppr/{{ $unemprunt['id_emprunt'] }}">
                    @csrf
                    <button type="submit">SUPPR</button>
                </form>
                </td>
            </tr>
            @endforeach
        </table>
        <a href="/create" class="btn btn-secondary" tabindex="-1" role="button">Créer un emprunt</a>
    
    <footer>
        <p>&copy; 2025 - Mon Site Laravel</p>
    </footer>
</body>
</html>