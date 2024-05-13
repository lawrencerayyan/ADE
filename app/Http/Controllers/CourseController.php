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

class CourseController extends Controller
{

    public function assignTeacher($id)
    {
        $cours = Cours::findOrFail($id);
        $enseignant = User::where('type', 'enseignant')->get();
        return view('admin.associate',['cours' => $cours, 'enseignants' => $enseignant]);
    }


    public function updateTeacher(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);
        $enseignant = User::findOrFail($request->input('enseignant'));
        $cours->users()->syncWithoutDetaching($enseignant->id);
        return view('prof.showcours', ['cours' => $cours, 'e' => $enseignant] );
    }


    // desassocier
    public function destroyUser($cours_id, $user_id)
    {
        $cours = Cours::findOrFail($cours_id);
        $cours->users()->detach($user_id);
        return redirect()->back();
    }

    public function supprimerCours($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->users()->detach();

        $cours->delete();
        return redirect()->back()->with('success', 'Cours Supprimé');
    }

    public function showCours(Formation $formation,Request $request)
    {

        $enseignants = User::where('type', 'enseignant')->get();
        $search = $request->input('search');
        $cours = Cours::query()
            ->when($search, function ($query, $search) {
                return $query->where('intitule', 'LIKE', '%'.$search.'%');
            })
            ->orderBy('intitule')
            ->get();
        return view('courses.show', ['cours'=>$cours, 'search' => $search , 'formation'=>$formation,'enseignants'=>$enseignants]);
    }



    public function create()
    {
        $formations = Formation::all();
        $user= User:: where ('type', '=' , 'admin')->get();
        return view('courses.create', compact('formations','user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'intitule' => 'required',
            'user_id' => 'required',
            'formation_id' => 'required',
        ]);

        $cours = new Cours();
        $cours->intitule = $request->input('intitule');
        $cours->user_id = $request->input('user_id');
        $cours->formation_id = $request->input('formation_id');
        $cours->save();

        return redirect()->route('courses.list')->with('success', 'Cours ajouté avec succès.');
    }

}
