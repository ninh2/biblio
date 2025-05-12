@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <div class="form-box">
        <form class="form" method="POST" action="{{ route('Connexion') }}">
            @csrf
            <span class="title">Connexion</span>
            <span class="subtitle">Veuillez renseigner:</span>
            <div class="form-container">
                <!-- Email -->
                <input type="email" class="input" placeholder="Email" name="email" value="{{ old('email') }}" required>

                <!-- Mot de passe -->
                <input type="password" class="input" placeholder="Mot de passe" name="password" required>
            </div>
            <button type="submit">Je me connecte</button>
        </form>

        <div class="form-section">
            <p>Vous n'avez pas de compte ? <a href="/Inscription">Je m'inscris</a></p>  
        </div>
    </div>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection



    <style>
        /* Styles généraux du formulaire de connexion */
.form-box {
    max-width: 400px;
    width: 100%;
    background: white;
    border-radius: 10px;
    color: #333;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    margin: 50px auto;
    text-align: center;
}

/* Titre et sous-titre */
.title {
    font-weight: bold;
    font-size: 1.8rem;
    color: #007bff;
    margin-bottom: 10px;
}

.subtitle {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
}

/* Conteneur des champs de formulaire */
.form-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Style des champs d'input */
.input {
    background: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 40px;
    width: 100%;
    font-size: 1rem;
    padding: 8px 15px;
    transition: border-color 0.3s ease;
}

.input:focus {
    border-color: #007bff;
    outline: none;
}

/* Bouton de connexion */
.form button {
    background-color: #007bff;
    color: #fff;
    border: 0;
    border-radius: 24px;
    padding: 12px 16px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

.form button:hover {
    background-color: #0056b3;
}

/* Lien pour l'inscription */
.form-section {
    padding: 16px;
    font-size: 0.9rem;
    background-color: #f1f7fe;
    border-top: 1px solid #ddd;
    margin-top: 15px;
    border-radius: 0 0 10px 10px;
}

.form-section a {
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.form-section a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Responsivité */
@media (max-width: 500px) {
    .form-box {
        width: 90%;
        padding: 20px;
    }

    .input {
        padding: 10px;
    }

    .form button {
        padding: 14px;
    }
}

    </style>
