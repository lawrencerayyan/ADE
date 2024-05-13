@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Utilisateurs en attente d'approbation</h1>

        <table class="table table-striped">
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
                @if ($user->type == null)
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->login }}</td>

                        <td>
                            <form method="POST" action="{{ route('users.validate', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="type"></label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="etudiant">Étudiant</option>
                                        <option value="enseignant">Enseignant</option>
                                        <option value="admin">Administrateur</option>
                                    </select><button type="submit" class="btn btn-primary">Valider</button>
                                </div>

                            </form>


                        </td>
                        <td>

                            <form method="POST" action="{{ route('users.destroy', $user->id) }}"onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="btn btn-danger">Refuser</button>
                            </form>
                        </td>
                    </tr>

                @endif
            @endforeach
            </tbody>
        </table>

        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
