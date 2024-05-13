@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Liste des cours de la formation "{{ $formation->intitule }}"</h1>
        <form action="" method="GET">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="query" placeholder="Rechercher un cours">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>


        <table class="table">
            <thead>
            <tr>
                <th>Nom du cours</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($cours as $cours)
                <tr>
                    <td>{{ $cours->intitule }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
