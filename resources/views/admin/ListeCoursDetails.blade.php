@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Détails du cours</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Intitule</th>
                <th>Enseignant(s)</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $cours->intitule }}</td>
                <td>
                    @if ($cours->users->count() > 0)
                        @foreach ($cours->users as $enseignant)
                            {{ $enseignant->nom }} {{ $enseignant->prenom }} <br>
                        @endforeach
                    @else
                        Aucun enseignant associé
                    @endif
                </td>
                <td>{{ $cours->formation->intitule }}</td>

            </tr>
            </tbody>
        </table>

        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
