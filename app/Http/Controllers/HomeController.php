<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Formation;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
            'mdp' => 'required|min:2|max:255',

            'type' => 'required|max:255'
        ]);

        // Création de l'utilisateur
        $user = new User();
        $user->nom = $validatedData['nom'];
        $user->prenom = $validatedData['prenom'];
        $user->login = $validatedData['login'];
        $user->mdp = Hash::make($validatedData['mdp']);
        $user->type = $validatedData['type'];
        $user->save();
        session()->flash('etat','User added');

        Auth::login($user);
        // Redirection vers une page de confirmation
        return redirect()->route('apresConnexion', ['user' => $user]);
    }

    public function registerEtudiant()
    {
        $formations = Formation::all();
        return view('utilisateur.registerEtudiant', ['formations' => $formations]);
    }

        public function storeEtudiant(Request $request)
        {
            // Validation des données
            $validatedData = $request->validate([
                'nom' => 'required|max:255',
                'prenom' => 'required|max:255',
                'login' => 'required|unique:users|max:255',
                'mdp' => 'required|min:2|max:255',
                'formation_id' => 'required|max:255'

            ]);

            // Création de l'utilisateur
            $user = new User();
            $user->nom = $validatedData['nom'];
            $user->prenom = $validatedData['prenom'];
            $user->login = $validatedData['login'];
            $user->mdp = Hash::make($validatedData['mdp']);
            $user->formation_id = $validatedData['formation_id'];
            $user->type = Null;
            $user->save();
            session()->flash('etat','User added');

            Auth::login($user);
            // Redirection vers une page de confirmation
            return redirect()->route('apresConnexion', ['user' => $user]);
        }


    public function showForm(){
        return view('utilisateur.login');
    }

    // login action
    public function login(Request $request){

        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string'
        ]);


        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $request->session()->flash('etat','Login successful');
            // Récupération de l'utilisateur connecté
            $user = Auth::user();

            // Redirection vers la vue apresConnexion avec les informations de l'utilisateur
            return redirect()->route('apresConnexion', ['user' => $user]);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
