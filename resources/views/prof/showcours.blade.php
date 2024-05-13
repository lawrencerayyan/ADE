@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Informations du cours</h1>
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><strong>Intitulé :</strong></td>
                <td>{{ $cours->intitule }}</td>
            </tr>
            <tr>
                <td><strong>Enseignant :</strong></td>
                <td>{{ $e->nom }} {{ $e->prenom }}</td>
            </tr>
            <tr>
                <td><strong>Formation :</strong></td>
                <td>{{ $cours->formation->intitule }}</td>
            </tr>
            </tbody>
        </table>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
