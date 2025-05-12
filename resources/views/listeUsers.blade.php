@extends('layouts.app')

@section('title', 'Users')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Liste des Utilisateurs</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->date_naissance }}</td>
                    <td>{{ $user->ville }}</td>
                    <td>{{ $user->statut }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                            <a href="{{ route('utilisateur.edit', ['id_utilisateur' => $user->id_utilisateur]) }}" class="btn btn-warning btn-sm">Éditer</a>
                            <form action="{{ route('utilisateur.supprimer', ['id_utilisateur' => $user->id_utilisateur]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection