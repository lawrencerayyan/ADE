@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Modifier la formation</h1>
        <form method="POST" action="{{ route('formations.update', $formation->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="intitule">Intitulé:</label>
                <input type="text" name="intitule" class="form-control" id="intitule" value="{{ $formation->intitule }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
