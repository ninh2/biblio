
@extends('layouts.app')
@section('title', 'Login')

@section('content')

    <h1>Connexion</h1>
        <form action="/Connexion" method="POST">
        @csrf

        <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
@endsection


