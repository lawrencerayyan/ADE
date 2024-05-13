<form action="{{ route('planning.enregistrerSeance') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="cours_id">Cours :</label>
        <select name="cours_id" id="cours_id" class="form-control">
            @foreach ($cours as $c)
                <option value="{{ $c->id }}">{{ $c->intitule }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="date_debut">Date et heure de début :</label>
        <input type="datetime-local" id="date_debut" name="date_debut" class="form-control">
    </div>
    <div class="form-group">
        <label for="date_fin">Date et heure de fin :</label>
        <input type="datetime-local" id="date_fin" name="date_fin" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>

</form>
<button onclick="window.history.back()">Retour</button>
<button type="button" class="bouton"><a href="/logout">Logout</a></button>
