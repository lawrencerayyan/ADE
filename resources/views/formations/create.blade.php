@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Ajouter une formation</h1>
        <form method="POST" action="{{ route('formations.store') }}">
            @csrf
            <div class="form-group">
                <label for="intitule">Intitulé:</label>
                <input type="text" name="intitule" class="form-control" id="intitule" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
