@extends('layouts.app')

@section('title', 'Éditer Utilisateur')

@section('content')
<div class="container mt-5">
    <h1>Éditer Utilisateur</h1>

    <form action="{{ route('utilisateur.update', ['id_utilisateur' => $utilisateur->id_utilisateur]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role">
                <option value="gestionnaire">gestionnaire</option>
                <option value="utilisateur">utilisateur</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut">
                <option value="en attente">en attente</option>
                <option value="inactif">inactif</option>
                <option value="actif">actif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
