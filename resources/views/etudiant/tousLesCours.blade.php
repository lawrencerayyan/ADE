@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Liste de tous les cours</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Nom du cours</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($coursDisponibles as $cour)
                <tr>
                    <td>{{ $cour->intitule }}
                        <form action="{{ route('etudiant.inscription', $cour->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="cours_id" value="{{ $cour->id }}">
                            <button type="submit" class="bouton">S'inscrire</button>
                        </form>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <button onclick="window.history.back()">Retour</button>
        <button type="button" class="bouton"><a href="/logout">Logout</a></button>
    </div>
@endsection
