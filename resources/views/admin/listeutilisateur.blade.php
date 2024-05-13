@extends('Main.modele')

@section('contents')

    <div class="container">
        <h1>Liste des utilisateurs</h1>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('utilisateurs.filtrer') }}" method="get">
                    <div class="form-group">
                        <label for="type">Filtre par type :</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Tous les types</option>
                            <option value="etudiant">Etudiant</option>
                            <option value="enseignant">Enseignant</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
            </div>
            <div class="col-md-8">
                <form action="{{ route('utilisateurs.rechercher') }}" method="get">
                    <div class="form-group">
                        <label for="search">Recherche par nom/prénom/login :</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ old('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->type }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('admin.destroy', $user->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
    </div>

    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
@endsection
