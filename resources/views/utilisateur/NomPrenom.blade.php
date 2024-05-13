
<h1>Modifier le nom ou le prenom </h1>

<form method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom">
    </div>

    <div>
        <label for="prenom">prenom :</label>
        <input type="text" name="prenom" id="prenom">

    </div>

    <button type="submit">Enregistrer les modifications</button>

</form> <button onclick="window.history.back()">Retour</button>
<button type="button" class="bouton"><a href="/logout">Logout</a></button>
