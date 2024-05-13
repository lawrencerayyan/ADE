<div class="container">
    <h1>Liste des cours de la formation {{ $formation->intitule }}</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Intitulé</th>
            <th>Enseignant</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cours as $c)
            <tr>
                <td>{{ $c->intitule }}</td>
                <td>{{ $c->enseignant->nom }} {{ $c->enseignant->prenom }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</div>
