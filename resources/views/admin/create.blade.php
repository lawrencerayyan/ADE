@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Ajouter un utilisateur</h1>
        <form action="{{ route('admin.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control" required>
            </div>
            <div>
                <label for="formation_id">Formation:</label>
                <select name="formation_id" id="formation_id">
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}">{{ $formation->intitule }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" >
                    <option value="">Sélectionner un type</option>
                    <option value="admin">Administrateur</option>
                    <option value="etudiant">Etudiant</option>
                    <option value="enseignant">enseignant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
