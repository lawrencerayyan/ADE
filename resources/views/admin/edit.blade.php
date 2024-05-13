<form action="{{ route('admin.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ $user->nom }}">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $user->prenom }}">
    </div>
    <div class="form-group">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" class="form-control" value="{{ $user->login }}">
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" class="form-control">
    </div>
    <div class="form-group">
        <label for="formation_id">Formation</label>
        <input type="number" name="formation_id" id="formation_id" class="form-control" >
    </div>
    <div class="form-group">
        <label for="type">Type :</label>
        <select name="type" id="type" class="form-control">
            <option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="etudiant" {{ $user->type === 'etudiant' ? 'selected' : '' }}>Etudiant</option>
            <option value="enseignant" {{ $user->type === 'enseignant' ? 'selected' : '' }}>enseignant</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
<button onclick="window.history.back()">Retour</button>
<button type="button" class="bouton"><a href="/logout">Logout</a></button>
