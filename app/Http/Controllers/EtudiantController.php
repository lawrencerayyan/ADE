<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Cours;
use App\Models\Formation;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class EtudiantController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $formation_id = $user->formation_id;
        $coursDeLaFormation = Cours::where('formation_id', $formation_id)->get();
        $coursDeLUtilisateur = $user->cours()->pluck('id')->toArray();
        $coursDisponibles = collect();

        foreach ($coursDeLaFormation as $cours) {
            if (!in_array($cours->id, $coursDeLUtilisateur)) {
                $coursDisponibles->push($cours);
            }
        }
        return view('etudiant.tousLesCours', compact('coursDisponibles'));
    }

    public function showCours(Formation $formation)
    {
        $user = Auth::user(); // récupérez l'utilisateur actuellement connecté
        $formation = $user->formation_id; // récupérez la formation choisie par l'utilisateur
        $cours = $formation->cours;
        return view('etudiant.cours', compact('formation', 'cours'));
    }
    // inscription dans un cours
    public function inscription($id) {
        $etudiant = Auth::user();
        $cours = Cours::find($id);
        $etudiant->cours()->attach($cours);
        return redirect()->route('etudiant.listeCours')->with('success', 'Inscription réussie');
    }


    public function storeInscription(Request $request) {
        $etudiant = Auth::user();
        $cours = Cours::find($request->input('cours_id'));
        $etudiant->cours()->attach($cours);
        return redirect()->route('etudiant.tousLesCours')->with('success', 'Inscription réussie');
    }

    public function desinscription(Request $request) {
        $etudiant = Auth::user();
        $cours = Cours::find($request->input('cours_id'));
        $etudiant->cours()->detach($cours);
        return redirect()->back()->with('success', 'Désinscription réussie');
    }


    //1.2.3. Liste des cours auxquels l"’étudiant est inscrit.
    public function ListeCoursinscriptions() {
        $etudiant = Auth::user();

        //        $cours = Cours:: where ('user_id', '=' , $etudiant->id)->get();
        $cours = $etudiant->cours;
        return view('etudiant.listeCoursIns', compact('cours'));
    }

    // Pas Ecnore fait
    public function rechercherCours($formation_id) {
        $etudiant = Auth::user();
        $formation = Formation::findOrFail($formation_id);
        $cours = Cours::where('formation_id', $formation_id)
            ->where('intitule', 'LIKE', '%'.request()->input('query').'%')
            ->get();
        return view('courses.listeRecherche', compact('cours','etudiant', 'formation'));
    }


}
