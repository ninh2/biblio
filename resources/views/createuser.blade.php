@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
    <div class="form-box">
    <form class="form" method="POST" action="{{ route('Inscription') }}">
    @csrf
    <span class="title">Je m'inscris</span>
    <span class="subtitle">Veuillez renseigner les champs suivants.</span>
    <div class="form-container">
        <!-- Champs du formulaire -->
        <input type="text" class="input" placeholder="Nom" name="nom" value="{{ old('nom') }}" required>
        <input type="text" class="input" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" required>
        <input type="email" class="input" placeholder="Email" name="email" value="{{ old('email') }}" required>
        <input type="date" class="input" name="dateDeNaissance" value="{{ old('dateDeNaissance') }}" required>
        <input type="password" class="input" placeholder="Mot de passe" name="password" required>
        <input type="text" class="input" placeholder="Adresse" name="adresse" value="{{ old('adresse') }}" required>
        <input type="text" class="input" placeholder="Code Postal" name="cp" value="{{ old('cp') }}" required>
        <input type="text" class="input" placeholder="Ville" name="ville" value="{{ old('ville') }}" required>
        
        <!-- Champ caché pour la case à cocher 'news' -->
        <input type="hidden" name="news" value="0">

        <!-- Case à cocher pour la newsletter -->
        <label>
            <input type="checkbox" name="news" value="1">
            Je souhaite recevoir la newsletter
        </label>
    </div>
    <button type="submit">Je m'inscris</button>
</form>

        <div class="form-section">
            <p>Vous avez déjà un compte ? <a href="/Connexion">Je me connecte</a></p>
        </div>
    </div>
 

@endsection



    <style>
/* Styles du formulaire */
.form-box {
    max-width: 500px;
    width: 100%;
    background: white;
    border-radius: 16px;
    color: #333;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    margin: 50px auto;
    text-align: center;
}

/* Texte du formulaire */
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

/* Conteneur des champs */
.form-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Champs d'input */
.input {
    background: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 40px;
    width: 100%;
    font-size: 1rem;
    padding: 8px 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
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

/* Section d'inscription */
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
  
    </style>

