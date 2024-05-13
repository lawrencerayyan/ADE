@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Liste des formations</h1>
        <div class="search">
            <form method="GET" action="{{ route('formations.search') }}">
                <input type="text" name="query" placeholder="Rechercher par intitulé...">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Intitulé</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($formations as $formation)
                <tr>
                    <td>{{ $formation->intitule }}</td>
                    <td>
                        <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-primary">Modifier</a>
                        <form method="POST" action="{{ route('formations.destroy', $formation->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('formations.create') }}" class="btn btn-success">Ajouter une formation</a>

    </div><button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
@endsection
