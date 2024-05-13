<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ModificationNomController extends Controller
{

// modifier le nom et le prénom, ça dirige vers le formulaire de modification
    public function edit()
    {
        return view('utilisateur.NomPrenom');
    }

// traiter la soumission du formulaire
    public function update(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
        ]);

        if(isset($validatedData['nom']) && !isset($validatedData['prenom'])) {
            $user->nom = $validatedData['nom'];
            $user->save();
        }

        if(isset($validatedData['prenom'])&& !isset($validatedData['nom'])) {
            $user->prenom = $validatedData['prenom'];
            $user->save();
        }
        if(isset($validatedData['prenom'])&& isset($validatedData['nom'])) {
            $user->nom = $validatedData['nom'];
            $user->prenom = $validatedData['prenom'];
            $user->save();
        }


        return redirect()->route('apresConnexion')->with('success', 'Nom et prenom ont été changé');
    }
}
