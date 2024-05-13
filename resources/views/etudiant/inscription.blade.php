<div class="container">
    <h1>Inscription au cours {{ $cours->nom }}</h1>
    <form action="{{ route('etudiant.inscription.store') }}" method="POST">
        @csrf
        <input type="hidden" name="cours_id" value="{{ $cours->id }}">
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</div>
