@extends('layouts.app')

@section('title', 'Modifier un éditeur')

@section('content')
    <div class="form-container">
        <h1>Modifier un éditeur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form" action="{{ route('editeurs.update', $editeur->id_editeur) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="libelle">Libellé :</label>
                <input type="text" id="libelle" name="libelle" value="{{ old('libelle', $editeur->libelle) }}" required>
                @error('libelle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Modifier l'éditeur</button>
        </form>

        <a href="{{ route('editeurs.index') }}" class="btn btn-warning back-link">Retour à la liste des éditeurs</a>
    </div>
@endsection