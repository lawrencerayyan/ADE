@extends('Main.modele')

@section('contents')

    <div class="container">
        <h1>Liste des cours</h1>
        <form method="GET" action="{{ route('courses.search') }}" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" value="{{ $search }}" placeholder="Rechercher par intitulé">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
            <button type="button" class="btn btn-primary"><a href="{{ route('courses.create') }}">Ajouter un cours</a></button>

        </div>
        <table class="table table-striped">

            <thead>
            <tr>
                <th>Intitule</th>
                <th>Enseignant</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>

            </thead>
            <tbody>
            @foreach ($cours as $c)
                <tr>
                    <td>{{ $c->intitule }}</td>

                    <td>
                        @if ($c->user)
                            {{ $c->user->nom }} {{ $c->user->prenom }}

                        @else
                            <form method="POST" action="{{ route('courses.assignTeacher', $c->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="enseignant">Enseignant:</label>
                                    <select name="enseignant" id="enseignant" class="form-control">
                                        @foreach ($enseignants as $e)
                                            <option value="{{ $e->id }}">{{ $e->nom }} {{ $e->prenom }}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Associer</button>
                            </form>
                        @endif
                    </td>
                    <td>{{ $c->formation->intitule }}</td>

                    <td>
                        <button type="button" class="btn btn-primary"><a href="{{ route('courses.showDetails', $c->id) }}">Voir</a></button>
                        <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$c->id}}').submit();">
                            Supprimer
                        </a>
                        <form id="delete-form-{{$c->id}}" action="{{route('cours.supprimer', $c->id)}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
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
