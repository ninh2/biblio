
@extends('layouts.app')

@section('title', 'Créer un ouvrage')

@section('content')
    <div class="form-container">
        <h1>Créer un ouvrage</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('ouvrages.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
                @error('titre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="code_isbn">Code ISBN (facultatif) :</label>
                <input type="text" id="code_isbn" name="code_isbn" value="{{ old('code_isbn') }}">
                @error('code_isbn')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_editeur">Éditeur :</label>
                <select id="id_editeur" name="id_editeur" required>
                    <option value="">Sélectionner un éditeur</option>
                    @foreach ($editeurs as $editeur)
                        <option value="{{ $editeur->id_editeur }}" {{ old('id_editeur') == $editeur->id_editeur ? 'selected' : '' }}>
                            {{ $editeur->libelle }}
                        </option>
                    @endforeach
                </select>
                @error('id_editeur')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Type :</label>
                <select id="type" name="type" required>
                    <option value="livre" {{ old('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                    <option value="magazine" {{ old('type') == 'magazine' ? 'selected' : '' }}>Magazine</option>
                    <option value="ebook" {{ old('type') == 'ebook' ? 'selected' : '' }}>Ebook</option>
                </select>
                @error('type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="auteurs">Auteurs :</label>
                <select id="auteurs" name="auteurs[]" multiple required>
                    @foreach ($auteurs as $auteur)
                        <option value="{{ $auteur->id_auteur }}" {{ in_array($auteur->id_auteur, old('auteurs', [])) ? 'selected' : '' }}>
                            {{ trim(preg_replace('/\s+/', ' ', $auteur->nom . ' ' . $auteur->prenom)) }}
                        </option>
                    @endforeach
                </select>
                @error('auteurs')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="genres">Genres :</label>
                <div class="genres">
                    @foreach ($genres as $genre)
                        <label>
                            <input type="checkbox" name="genres[]" value="{{ $genre->id_genre }}"
                                {{ in_array($genre->id_genre, old('genres', [])) ? 'checked' : '' }}>
                            {{ $genre->libelle }}
                        </label>
                    @endforeach
                </div>
                @error('genres')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Créer l'ouvrage</button>
        </form>

        <a href="{{ route('ouvrages') }}" class="btn btn-warning back-link">Retour à la liste des ouvrages</a>
    </div>
@endsection
