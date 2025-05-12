<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif d'emprunt</title>
</head>
<body>
    <h1>Modif emprunt</h1>
    <form method="post" action="/update/enregistrement_emp">
       @csrf 
        <input type="hidden" id="id" name="id" value="{{ $emprunts->id_emprunt }}" required>
        <br>

        <label for="date_emprunt">Date de l'emprunt :</label>
        <input type="date" id="date_emprunt" name="date_emprunt" required>
        <br>

        <button type="submit">Valider</button>
    </form>

</body>
</html>