@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Liste des cours auxquels vous êtes inscrit</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Nom du cours</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($cours as $cour)
                <tr>
                    <td>{{ $cour->intitule }}</td>

                    <td>
                        <form action="{{ route('etudiant.desinscription') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cours_id" value="{{ $cour->id }}">
                            <button type="submit">Se désinscrire</button>
                        </form>
                    </td>
                    <td><a href="{{ route('etudiant.listeCoursFormation', $cour->formation->id) }}">Voir les cours de la formation</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
