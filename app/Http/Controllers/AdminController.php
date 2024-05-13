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


class AdminController extends Controller
{
    public function index()
    {
        $users = User::whereNull('type')->get(); // récupère les utilisateurs en attente d'approbation
        return view('admin.validate', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->type = $request->input('type');
        $user->save();
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('etat', 'Utilisateur supprimé avec succès');
        return redirect()->back();
    }

    public function allutilisateur()
    {
        $users = User::all();

        return view('admin.listeutilisateur', compact('users'));
    }

    public function create()
    {
        $formations = Formation::all();
        return view('admin.create', ['formations' => $formations]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'login' => 'required|string|unique:users,login',
            'mdp' => 'required|string',
            'formation_id' => 'nullable|integer',
            'type' => 'nullable|string',
        ]);

        $user = new User();
        $user->nom = $validatedData['nom'];
        $user->prenom = $validatedData['prenom'];
        $user->login = $validatedData['login'];
        $user->mdp = Hash::make($validatedData['mdp']);
        if (isset($validatedData['type'])) {
            $user->type = $validatedData['type'];
        }
        if (isset($validatedData['formation_id'])) {
            $user->formation_id = $validatedData['formation_id'];
        }
        $user->save();

        return redirect()->route('utilisateurs.all')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function updateuser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nom' => 'nullable|string',
            'prenom' => 'nullable|string',
            'login' => 'nullable|string|unique:users,login,'.$user->id,
            'mdp' => 'nullable|string',
            'formation_id' => 'nullable|integer',
            'type' => 'nullable|string',
        ]);

        if (isset($validatedData['nom'])) {
            $user->nom = $validatedData['nom'];
        }
        if (isset($validatedData['prenom'])) {
            $user->prenom = $validatedData['prenom'];
        }
        if (isset($validatedData['login'])) {
            $user->login = $validatedData['login'];
        }
        if (isset($validatedData['mdp'])) {
            $user->mdp = Hash::make($validatedData['mdp']);
        }
        if (isset($validatedData['type'])) {
            $user->type = $validatedData['type'];
        }
        if (isset($validatedData['formation_id'])) {
            $user->formation_id = $validatedData['formation_id'];
        }

        $user->save();

        return redirect()->route('utilisateurs.all')
            ->with('success', 'User updated successfully');
    }



    public function destroyuser(User $user)
    {
        $user->delete();

        return redirect()->route('utilisateurs.all')
            ->with('success', 'User deleted successfully');
    }

    public function show($id)
    {
        $cours = Cours::findOrFail($id);
        $enseignant = $cours->user;
        return view('admin.ListeCoursDetails', ['cours' => $cours, 'enseignant' => $enseignant]);
    }
    public function filter(Request $request)
    {
        $type = $request->input('type');
        $users = User::when($type, function ($query, $type) {
            return $query->where('type', $type);
        })->get();

        return view('admin.listeutilisateur', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('nom', 'like', '%'.$search.'%')
            ->orWhere('prenom', 'like', '%'.$search.'%')
            ->orWhere('login', 'like', '%'.$search.'%')
            ->get();

        return view('admin.listeutilisateur', compact('users'));
    }
}
