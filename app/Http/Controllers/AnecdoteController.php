<?php

namespace App\Http\Controllers;

use App\Models\anecdote;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnecdoteController extends Controller
{
    public function index()
    {
        $anecdotes = Anecdote::all();
        return view('anecdotes.index', compact('anecdotes'));
    }

    public function create()
    {

        return view('anecdotes.create');
    }

    public function store(Request $request)
    {
        Log::info('Début de la fonction store');

        try {
            Log::info('Données reçues:', $request->all());

            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'relation' => 'required|string|max:255',
                'ville' => 'required|string|max:255',
                'pays' => 'required|string|max:255',
                'anecdote' => 'required|string|max:500',
            ]);

            Log::info('Données validées:', $validatedData);

            $anecdote = Anecdote::create($validatedData);

            return redirect()->route('anecdotes')->with('success', 'Anecdote soumise avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'anecdote:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la soumission de l\'anecdote. Veuillez réessayer.');
        }
    }

   public function downloadPDF(Request $request)
{
    $html = $request->input('html');
    $pdf = SnappyPdf::loadHTML($html);
    $pdfName = 'livre_d_anecdotes.pdf';
    $pdfPath = $pdf->save($pdfName);

    return response()->download($pdfPath, $pdfName);
}
}
