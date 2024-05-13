<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function register()
{
    return view('utilisateur.register');
}
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'login' => 'required|unique:users|max:255',
            'mdp' => 'required|max:255',
            'formation_id' => 'required',
            'type' => 'required|max:255'
        ]);

        // Création de l'utilisateur
        $user = new User();
        $user->nom = $validatedData['nom'];
        $user->prenom = $validatedData['prenom'];
        $user->login = $validatedData['login'];
        $user->mdp = bcrypt($validatedData['mdp']);
        $user->formation_id = $validatedData['formation_id'];
        $user->type = $validatedData['type'];
        $user->save();

        // Redirection vers une page de confirmation
        return redirect()->route('/')->with('success', 'Votre compte a été créé avec succès.');
    }
}
