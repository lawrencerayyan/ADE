<form method="POST">
    @csrf

    <div>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required autofocus>
    </div>

    <div>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" required>
    </div>

    <div>
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required>
    </div>

    <div>
        <label for="mdp">Mot de passe:</label>
        <input type="password" name="mdp" id="mdp" required>
    </div>


    <div class="form-group">
        <label for="type">Type d'utilisateur:</label>
        <select name="type" id="type" class="form-control">
            <option value="enseignant">Enseignant</option>
            <option value="admin">Administrateur</option>
        </select>
    </div>

    <div>
        <button type="submit">Créer un compte</button>
    </div>
    @csrf
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</form>
