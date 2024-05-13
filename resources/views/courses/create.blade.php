@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Ajouter un cours</h1>
        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            <div class="form-group">
                <label for="intitule">Intitulé:</label>
                <input type="text" class="form-control" id="intitule" name="intitule">
            </div>
            <div>
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id">
                    @foreach ($user as $u)
                        <option value="{{ $u->id }}">{{ $u->nom }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="formation_id">Formation:</label>
                <select name="formation_id" id="formation_id">
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}">{{ $formation->intitule }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
