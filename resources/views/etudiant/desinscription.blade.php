<form action="/etudiant/desinscription" method="POST">
    @csrf
    <input type="hidden" name="cours_id" value="{{ $cours->id }}">
    <button type="submit">Se désinscrire</button>

    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</form>
