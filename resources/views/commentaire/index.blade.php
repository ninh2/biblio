@extends('layouts.app')

@section('content')
    <h1>Liste des Commentaires</h1>

    <a href="{{ route('commentaires.create') }}" class="btn btn-primary">Ajouter un commentaire</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ouvrage</th>
                <th>Statut</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commentaires as $commentaire)
                <tr>
                    <td>{{ $commentaire->id_commentaire }}</td>
                    <td>{{ $commentaire->ouvrage ? $commentaire->ouvrage->titre : 'Aucun ouvrage' }}</td>
                    <td>{{ $commentaire->statut }}</td>
                    <td>{{ $commentaire->note }}</td>
                    <td>
                        <a href="{{ route('commentaires.edit', $commentaire->id_commentaire) }}" class="btn btn-warning btn-sm">Modifier</a>
                        
                        <form action="{{ route('commentaires.destroy', $commentaire->id_commentaire) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
