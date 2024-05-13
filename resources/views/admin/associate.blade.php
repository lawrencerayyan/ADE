@extends('Main.modele')

@section('contents')
    <h1>Assigner un enseignant à "{{ $cours->intitule }}"</h1>
    <form action="{{ route('courses.updateTeacher', ['id' => $cours->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="enseignant">Enseignant :</label>
            <select name="enseignant" id="enseignant" class="form-control">
                @foreach ($enseignants as $enseignant)
                    <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assigner</button>
    </form>
    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
@endsection
