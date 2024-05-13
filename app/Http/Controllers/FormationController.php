<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
    }

    public function listeCoursFormation($formation_id)
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();

        // Récupérer la formation correspondante à l'ID
        $formation = Formation::findOrFail($formation_id);

        // Récupérer la liste des cours de la formation dans lesquels l'étudiant est inscrit
        $cours = $etudiant->cours()->where('formation_id', $formation_id)->get();

        // Retourner la vue avec les données
        return view('etudiant.listeCoursFormation', compact('formation', 'cours'));
    }


    public function create()
    {
        return view('formations.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|unique:formations|max:50',
        ]);

        $formation = new Formation;
        $formation->intitule = $validatedData['intitule'];
        $formation->save();

        return redirect()->route('formations.index')
            ->with('success', 'Formation ajoutée avec succès.');
    }

    public function edit($id)
    {
        $formation = Formation::find($id);
        return view('formations.edit', compact('formation'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|unique:formations,intitule,'.$id.'|max:50',
        ]);

        $formation = Formation::find($id);
        $formation->intitule = $validatedData['intitule'];
        $formation->save();

        return redirect()->route('formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }

    public function destroy($id)
    {
        $formation = Formation::find($id);
        $formation->delete();

        return redirect()->route('formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $formations = Formation::where('intitule', 'LIKE', "%$query%")->paginate(10);
        return view('formations.index', compact('formations'));
    }
}
