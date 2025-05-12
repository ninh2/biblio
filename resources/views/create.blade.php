<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie d'emprunt</title>
</head>
<body>
    <h1>Saisie emprunt</h1>
    <form method="post" action="/create/enregistrement">
       @csrf 
       <label for="ouvrage">Numéro ouvrage :</label>
        <input type="text" id="ouvrage" name="ouvrage" required>
        <br>

        <label for="utilisateur">Numéro utilisateur :</label>
        <input type="text" id="utilisateur" name="utilisateur" required>
        <br>

        <label for="date_emprunt">Date de l'emprunt :</label>
        <input type="date" id="date_emprunt" name="date_emprunt" required>
        <br>

        <button type="submit">Valider</button>
    </form>

</body>
</html>