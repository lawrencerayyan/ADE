<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Cours;
use App\Models\Formation;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/apresConnexion', function () {
    return view('apresConnexion');
})->name('apresConnexion');

Route::get('/admin/list-cours', function () {
    return view('courses.show');
})->name('courses.show');

// formulaire d'inscr
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\HomeController::class, 'store']);
// formulaire d'inscr Etudiant
Route::get('/registerEtudiant', [App\Http\Controllers\HomeController::class, 'registerEtudiant'])->name('registerEtudiant');
Route::post('/registerEtudiant', [App\Http\Controllers\HomeController::class, 'storeEtudiant']);

Route::get('/users', [App\Http\Controllers\AdminController::class, 'index'])->name('users.index');
Route::put('/users/{user}/validate', [App\Http\Controllers\AdminController::class, 'update'])->name('users.validate');
Route::put('/users/{user}/refuser', [App\Http\Controllers\AdminController::class, 'destroy'])->name('users.destroy');

//
Route::get('/login', [App\Http\Controllers\HomeController::class,'showForm'])
    ->name('login');
Route::post('/login', [App\Http\Controllers\HomeController::class,'login']);

Route::get('/logout', [App\Http\Controllers\HomeController::class,'logout'])
    ->name('logout');

//
// afficher le formulaire de changement de mot de passe :
Route::get('/changer-mot-de-passe', [App\Http\Controllers\ChangementMotDePasseController::class, 'edit'])->name('changer-mot-de-passe.edit');
// traiter le formulaire de changement de mot de passe :
Route::put('/changer-mot-de-passe', [App\Http\Controllers\ChangementMotDePasseController::class, 'update'])->name('changer-mot-de-passe.update');

// modification du nom/prenom
Route::get('/modifier', [App\Http\Controllers\ModificationNomController::class, 'edit'])->name('modification.edit');
// traiter la soumission du formulaire de modification :
Route::put('/modifier', [App\Http\Controllers\ModificationNomController::class, 'update'])->name('modification.update');

//association d'un enseignant à un cours
Route::put('/cours/{id}/assign-teacher', [App\Http\Controllers\CourseController::class ,'assignTeacher'])->name('courses.assignTeacher');
Route::put('/cours/{id}/update-teacher', [App\Http\Controllers\CourseController::class ,'updateTeacher'])->name('courses.updateTeacher');

Route::delete('cours/{cours_id}/users/{user_id}', [App\Http\Controllers\CourseController::class, 'destroyUser'])->name('cours.desassocier');
//Suprimer un cours
Route::delete('/cours/{id}', [App\Http\Controllers\CourseController::class, 'supprimerCours'])->name('cours.supprimer');


Route::get('/list', [App\Http\Controllers\CourseController::class, 'ShowCours'])->name('courses.list');
// rechercher
Route::get('/courses/search', [App\Http\Controllers\CourseController::class, 'ShowCours'])->name('courses.search');
// création du cours
Route::get('/courses/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses.create');
// enregistrer le cours dans la base de données
Route::post('/courses', [App\Http\Controllers\CourseController::class, 'store'])->name('courses.store');

// liste de formation
Route::get('/formations', [App\Http\Controllers\FormationController::class, 'index'])->name('formations.index');
//liste de formation dans lequel l'etudiant est inscrit
Route::get('/etudiant/liste-cours-formation/{formation_id}', [App\Http\Controllers\FormationController::class, 'listeCoursFormation'])->name('etudiant.listeCoursFormation');

// Afficher le formulaire d'ajout d'une formation
Route::get('/formations/create', [App\Http\Controllers\FormationController::class, 'create'])->name('formations.create');

// Enregistrer une nouvelle formation
Route::post('/formations', [App\Http\Controllers\FormationController::class, 'store'])->name('formations.store');

// Afficher le formulaire de modification d'une formation
Route::get('/formations/{id}/edit', [App\Http\Controllers\FormationController::class, 'edit'])->name('formations.edit');

// Mettre à jour une formation
Route::put('/formations/{id}', [App\Http\Controllers\FormationController::class, 'update'])->name('formations.update');

// Supprimer une formationé
Route::delete('/formations/{id}', [App\Http\Controllers\FormationController::class, 'destroy'])->name('formations.destroy');

// Rechercher une formation
Route::get('/formations/search', [App\Http\Controllers\FormationController::class, 'search'])->name('formations.search');
// rechercher un cours dans une formation

//une liste de tous les cours
Route::get('/etudiant/liste-cours', [App\Http\Controllers\EtudiantController::class, 'index'])->name('etudiant.listeCours');

// liste de formation dans laquelle l'étudiant(e) est inscrit(e)
Route::get('/formations/{formation}/cours', [App\Http\Controllers\EtudiantController::class, 'showCours'])->name('etudiant.cours');
// inscription dans un cours :
//Route::GET('/etudiant/inscription', [App\Http\Controllers\EtudiantController::class, 'inscription'])->name('etudiant.inscription');
//Route::get('/etudiant/inscription/{id}', [App\Http\Controllers\EtudiantController::class, 'inscription'])->name('etudiant.inscription');
//Route::post('/etudiant/inscription', [App\Http\Controllers\EtudiantController::class, 'storeInscription'])->name('etudiant.inscription.store');
Route::post('/etudiant/inscription/{id}', [App\Http\Controllers\EtudiantController::class, 'Inscription'])->name('etudiant.inscription');


//desinscription
Route::POST('/etudiant/desinscription', [App\Http\Controllers\EtudiantController::class, 'desinscription'])->name('etudiant.desinscription');
// la Liste de Cours dans laquelle l'etudiant est inscrit
Route::GET('/etudiant/ListeCoursinscriptions', [App\Http\Controllers\EtudiantController::class, 'ListeCoursinscriptions'])->name('etudiant.ListeCoursinscriptions');
// admin create utilisateur


        // Routes pour gérer les utilisateurs
        Route::get('/admin/liste', [App\Http\Controllers\AdminController::class, 'allutilisateur'])->name('utilisateurs.all');

        Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/liste', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');

        Route::get('/admin/{user}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/{user}', [App\Http\Controllers\AdminController::class, 'updateuser'])->name('admin.update');

        Route::delete('/admin/{user}', [App\Http\Controllers\AdminController::class, 'destroyuser'])->name('admin.destroy');

Route::get('/admin/filtrer', [App\Http\Controllers\AdminController::class, 'filter'])->name('utilisateurs.filtrer');
Route::get('/admin/rechercher', [App\Http\Controllers\AdminController::class, 'search'])->name('utilisateurs.rechercher');

Route::get('/cours/{id}', [App\Http\Controllers\AdminController::class, 'show'])->name('courses.showDetails');

// la liste des cours des enseignant
Route::get('/enseignant/liste-cours', [App\Http\Controllers\EnseignantController::class, 'listeCours'])->name('enseignant.listeCours');

// PLANNING:
Route::get('/planning', [App\Http\Controllers\PlanningController::class, 'index'])->name('planning.index');

// Creation d'une nouvelle Plannig
Route::get('/planning/ajouter', [App\Http\Controllers\PlanningController::class, 'ajouterSeance'])->name('planning.ajouterSeance');
Route::post('/planning/enregistrer-seance', [App\Http\Controllers\PlanningController::class, 'enregistrerSeance'])->name('planning.enregistrerSeance');

// modifier une seance
Route::get('/planning/{id}/modifier-seance/{seance_id}', [App\Http\Controllers\PlanningController::class, 'modifierSeance'])->name('planning.modifierSeance');
Route::put('/planning/{id}/enregistrer-modification-seance', [App\Http\Controllers\PlanningController::class, 'enregistrerModificationSeance'])->name('planning.enregistrerModificationSeance');
//la suppression
Route::delete('/planning/{id}', [App\Http\Controllers\PlanningController::class, 'supprimer'])->name('planning.supprimer');
