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

class EnseignantController extends Controller
{
    public function listeCours()
    {
        $enseignant = Auth::user();
        $cours = $enseignant->cours;

        return view('enseignant.listeCours', ['cours' => $cours]);
    }
}
