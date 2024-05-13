<!DOCTYPE html>
<html>
<style>
    .bouton {
        background-color: blue;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .bouton:hover {
        background-color: lightblue;
    }
    a {
        color: white;
        text-decoration: none;
    }
</style>
<head>
    <title>Bienvenue sur le Planning</title>

</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1 style="margin: 0;">Bienvenue sur le Planning</h1>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</div>


@if(auth()->user() && auth()->user()->type === 'admin')

    <button class="bouton">  <a href="{{ route('users.index') }}">Valider les utilisateur en attantes </a> </button>
    <button class="bouton">  <a href="{{route('utilisateurs.all')}}">Voir les utilisateur</a> </button>
    <button class="bouton">  <a href="{{route('courses.list')}}">Liste des cours</a> </button>
    <button class="bouton">  <a href="{{route('formations.index')}}">Liste des formations</a> </button>

@endif

 @if(auth()->user() && auth()->user()->type === 'etudiant')
    <!--  <div class="container">
        <h1>Liste des cours de la formation  $user->formation->intitule }}</h1>
        <button type="button" class="btn btn-primary"><a href=" route('etudiant.cours', $user->formation->id) }}">Voir les cours</a></button>
    </div>-->
    <button class="bouton">  <a href="{{route('etudiant.ListeCoursinscriptions')}}">Mes Cours </a> </button>


    <button class="bouton">  <a href="{{route('etudiant.listeCours')}}">Tous les Cours</a> </button>
@endif


@if(auth()->user() && auth()->user()->type === 'enseignant')

    <button class="bouton">  <a href="{{route('enseignant.listeCours')}}">Liste de mes cours</a> </button>
    <button class="bouton">  <a href="{{route('planning.index')}}">Liste des Plannings</a> </button>

@endif


<button class="bouton">   <a href="{{ route('changer-mot-de-passe.edit') }}">Changer votre mot de passe</a></button>
<button class="bouton">   <a href="{{ route('modification.edit') }}">Changer son Prenom/Nom</a></button>




</body>
</html>
