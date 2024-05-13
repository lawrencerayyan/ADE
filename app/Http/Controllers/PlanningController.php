<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cours;
use App\Models\Formation;
use App\Models\Planning;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PlanningController extends Controller
{

    public function index()
    {
        $cours = Cours::all();
        $plannings = collect(); // initialisez une nouvelle collection vide de plannings
        foreach ($cours as $c) {
            $plannings = $plannings->merge($c->planning);
        }
        $plannings = $plannings->sortBy('date_debut');
        return view('planning.liste', compact('cours', 'plannings'));
    }

    public function ajouterSeance()
    {
        //$planning = Planning::all();
        //return view('planning.ajouterSeance', compact('planning'));
        $planning = Planning::all()->load('cours');
        $cours = Cours::all();
        return view('planning.ajouterSeance', compact('planning', 'cours'));
    }

    public function enregistrerSeance(Request $request)
    {
        $request->validate([
            'cours_id' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        $planning = new Planning();
        $planning->cours_id = $request->cours_id;
        $planning->date_debut = $request->date_debut;
        $planning->date_fin = $request->date_fin;
        $planning->save();

        return redirect()->route('planning.index')->with('success', 'La séance de cours a été ajoutée avec succès.');
    }

    public function modifierSeance($id)
    {
        $planning = Planning::findOrFail($id);
        $cours = Cours::findOrFail($planning->cours_id);
        return view('planning.modifierSeance', compact('planning', 'cours'));
    }

    public function enregistrerModificationSeance(Request $request, $id)
    {
        $request->validate([

            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        $planning = Planning::findOrFail($id);


        $planning->date_debut = $request->date_debut;
        $planning->date_fin = $request->date_fin;
        $planning->save();

        return redirect()->route('planning.index')->with('success', 'La séance de cours a été modifiée avec succès.');
    }

    public function supprimer($id)
    {
        $planning = Planning::findOrFail($id);
        $planning->delete();
        return redirect()->back()->with('success', 'Le planning de cours a été supprimé avec succès.');
    }


}
