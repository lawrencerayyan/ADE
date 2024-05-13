@extends('Main.modele')

@section('contents')
    <div class="container">
        <h1>Liste des plannings</h1>
        <button class="bouton">  <a href="{{route('planning.ajouterSeance')}}">ajouter un Planning</a> </button>
        <table class="table table-striped">
            <thead>
            <tr>

                <th>Cours</th>
                <th>Date de début  /  Date de fin</th>
<th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plannings as $planning)
                <tr>

                    <td>{{$planning->cours->intitule}}</td>
                    <td>{{$planning->date_debut}}  /  {{$planning->date_fin}}</td>
    <td><button class="bouton">  <a href="{{route('planning.modifierSeance', ['id' => $planning->id, 'seance_id' => $planning->cours->id])}}">Modifier</a> </button>
        <form action="{{ route('planning.supprimer', $planning->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce planning de cours ?')">Supprimer</button>
        </form>
    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
@endsection
