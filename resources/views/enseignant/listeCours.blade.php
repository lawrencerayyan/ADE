<div class="container">
    <h1>Liste des cours</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Nom du cours</th>
            <th>Formation</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($cours as $cour)
            <tr>
                <td>{{ $cour->intitule}}</td>
                <td>{{ $cour->formation->intitule }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button onclick="window.history.back()">Retour</button>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</div>
