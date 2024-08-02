<?php

namespace App\Http\Controllers;

use App\Models\anecdote;
use Illuminate\Http\Request;

class AnecdoteController extends Controller
{
    public function index()
    {
        $anecdotes = Anecdote::all();
        return view('anecdotes.index', compact('anecdotes'));
    }

    public function create()
    {
        $cities = ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice'];
        $countries = ['France', 'Allemagne', 'Espagne', 'Italie', 'Royaume-Uni'];
        $liens = ['Enfants', 'Petits-enfants', 'Gendres/Brue', 'Famille', 'Belle Famille', 'Amis', 'Connaissance'];
        return view('anecdotes.create', compact('cities','countries', 'liens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'relation' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'anecdote' => 'required|string|max:500',
        ]);

        Anecdote::create($request->all());

        return redirect()->route('home')->with('success', 'Anecdote soumise avec succès !');
    }
}
