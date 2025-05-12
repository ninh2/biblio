@extends('layouts.app')

@section('title', 'Les ouvrages')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Liste des ouvrages</h1>

        @if (session('user') && session('user')['role'] === 'gestionnaire')
            <a href="{{ route('ouvrages.create') }}" class="btn btn-primary mb-4">Ajouter un ouvrage</a>
        @endif

        <div class="table-responsive">
            @if (session('user') && session('user')['role'] === 'gestionnaire')
                <!-- Tableau pour les gestionnaires -->
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Éditeur</th>
                            <th scope="col">Type</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Genres</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ouvrages as $ouvrage)
                            <tr>
                                <td>{{ $ouvrage->titre }}</td>
                                <td>{{ $ouvrage->code_isbn ?: 'N/A' }}</td>
                                <td>{{ $ouvrage->editeur ? $ouvrage->editeur->libelle : 'Aucun éditeur' }}</td>
                                <td>{{ ucfirst($ouvrage->type) }}</td>
                                <td>
                                    @if ($ouvrage->auteurs->isNotEmpty())
                                        @foreach ($ouvrage->auteurs as $auteur)
                                            {{ $auteur->nom }} {{ $auteur->prenom }}@if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Aucun auteur
                                    @endif
                                </td>
                                <td>
                                    @if ($ouvrage->genres->isNotEmpty())
                                        @foreach ($ouvrage->genres as $genre)
                                            {{ $genre->libelle }}@if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Aucun genre
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('ouvrages.edit', $ouvrage->id_ouvrage) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('ouvrages.destroy', $ouvrage->id_ouvrage) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet ouvrage ?')">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Aucun ouvrage trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <!-- Tableau pour les non-gestionnaires -->
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Éditeur</th>
                            <th scope="col">Type</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">Genres</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ouvrages as $ouvrage)
                            <tr>
                                <td>{{ $ouvrage->titre }}</td>
                                <td>{{ $ouvrage->code_isbn ?: 'N/A' }}</td>
                                <td>{{ $ouvrage->editeur ? $ouvrage->editeur->libelle : 'Aucun éditeur' }}</td>
                                <td>{{ ucfirst($ouvrage->type) }}</td>
                                <td>
                                    @if ($ouvrage->auteurs->isNotEmpty())
                                        @foreach ($ouvrage->auteurs as $auteur)
                                            {{ $auteur->nom }} {{ $auteur->prenom }}@if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Aucun auteur
                                    @endif
                                </td>
                                <td>
                                    @if ($ouvrage->genres->isNotEmpty())
                                        @foreach ($ouvrage->genres as $genre)
                                            {{ $genre->libelle }}@if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Aucun genre
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Description</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Aucun ouvrage trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection