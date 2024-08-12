<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\other;
use App\Models\position;
use App\Models\prestataire;
use App\Models\Service;
use App\Models\tansaction;
use Illuminate\Http\Request;
use App\Models\user_prestataire;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\piece;

class commercialController extends Controller
{


    public function index()
    {
        try {
            // Récupérer les IDs des prestataires associés à l'utilisateur connecté
            $prestaAddedID = Auth::user()->prestataires()->pluck('id');
            Log::info('IDs des prestataires associés récupérés:', ['prestaAddedID' => $prestaAddedID]);
    
            // Vérifier si $prestaAddedID est vide
            if ($prestaAddedID->isEmpty()) {
                Log::info('Aucun prestataire associé trouvé, redirection vers la page de connexion.');
                return redirect()->route('login');
            }
     
            Log::info('IDs des prestataires trouvés.');
    
            // Calculer le montant total des transactions pour les prestataires associés
            $totalAmount = tansaction::whereIn('id_prestataire', $prestaAddedID)->sum('montant');
            Log::info('Montant total des transactions:', ['totalAmount' => $totalAmount]);
    
            // Calculer le revenu actuel basé sur un pourcentage
            $revenuePercentage = 0.20;
            $currentRevenue = $totalAmount * $revenuePercentage;
            Log::info('Revenu actuel calculé:', ['currentRevenue' => $currentRevenue]);
    
            // Récupérer les prestataires ajoutés avec leurs entreprises et services associés
            $prestaAdded = Auth::user()->prestataires()->with('entreprise', 'service')->get();
            Log::info('Prestataires récupérés avec entreprises et services.', ['prestaAdded' => $prestaAdded]);
    
            // Retourner la vue avec les variables nécessaires
            return view('commecials.index', compact('prestaAdded', 'currentRevenue'));
        } catch (\Throwable $e) {
            // Loguer les erreurs éventuelles
            Log::error('Erreur dans la fonction index des commerciaux: ' . $e->getMessage());
            return $this->handleError($e);
        }
    }
    

    public function createForComm()
    {
        try {
            $pieces = piece::all();
            $services = service::all()->sortBy('nom');
            return view('commercials.create', compact('services', 'pieces'));
        } catch (\Throwable $e) {
            Log::error('Erreur dans la fonction createForComm: ' . $e->getMessage());
            return $this->handleError($e);
        }
    }

    public function createStandardForComm()
    {
        try {
            $pieces = piece::all();
            $services = Service::all()->sortBy('nom');
            return view('commercials.standard', compact('services', 'pieces'));
        } catch (\Throwable $e) {
            Log::error('Erreur dans la fonction createStandardForComm: ' . $e->getMessage());
            return $this->handleError($e);
        }
    }

    private function handleError(\Throwable $e)
    {
        if (config('app.debug')) {
            Log::debug('Détails de l\'erreur en mode debug: ' . $e->getTraceAsString());
        }
        return view('error');
    }


    //Pour enrgistrer un prestataire 


    public function storeForComm(Request $request)
    {
        try {
            $data = $request->validate([
                'nom_service' => 'required|string',
                'statut' => 'required|string',
                'nom_presta' => 'required|string',
                'prenom_presta' => 'required|string',
                'nom_entrep' => 'nullable|string',
                'tel_entrep' => 'nullable|string',
                'tel_presta' => 'nullable|string',
                'email' => 'nullable|email',
                'reputation' => 'nullable|integer',
                'other_name' => 'nullable|string',
                'other_prenom' => 'nullable|string',
                'other_tel' => 'nullable|string',
                'cip' => 'required|string',
                'ifu' => 'required|string',
                'pays' => 'required|string',
                'type_piece' => 'required',
                'quartier' => 'required|exists:quartier,id',
            ]);



            $entreprise = Entreprise::create([
                'nom' => $data['nom_entrep'] ?? null, // `null` si aucune donnée
                'telephone' => $data['tel_entrep'] ?? null,
                'email' => $data['email'] ?? null,
                'reputation' => 25,
                'id_quartier' => $data['quartier'],
            ]);
            Log::info('Entreprise enregistrée:', $entreprise->toArray());



            $prestataire = Prestataire::create([
                'nom' => $data['nom_presta'],
                'prenom' => $data['prenom_presta'],
                'status' => $data['statut'],
                'telephone' => $data['tel_presta'] ?? null,
                'id_entreprise' => $entreprise->id,
                'id_service' => $data['nom_service'],
                'pays' => $data['pays'],
                'cip' => $data['cip'],
                'ifu' => $data['ifu'],
                'id_piece' => $data['type_piece'],

            ]);
            Log::info('Prestataire enregistré:', $prestataire->toArray());



            Other::create([
                'nom' => $data['other_name'] ?? null,
                'prenom' => $data['other_prenom'] ?? null,
                'telephone' => $data['other_tel'] ?? null,
                'id_entreprise' => $entreprise->id,
            ]);
            Log::info('Autre information enregistrée.');

            //Pour connaitre le commercial qui a enregistré un prestataire;
            user_prestataire::create([
                'user_id' => Auth()->user()->id,
                'prestataire_id' => $prestataire->id,
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Prestataire enregistré avec succès!',
                'prestataire_id' => $prestataire->id
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement du prestataire:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue .' . $e->getMessage()
            ], 500);
        }
    }

    public function storeStandardForComm(Request $request)
    {
        try {
            $data = $request->validate([
                'nom_service' => 'required|string',
                'statut' => 'bail|string',
                'nom_presta' => 'required|string',
                'prenom_presta' => 'required|string',
                'nom_entrep' => 'nullable|string',
                'tel_entrep' => 'nullable|string',
                'tel_presta' => 'nullable|string',
                'email' => 'nullable|email',
                'reputation' => 'nullable|integer',
                'other_name' => 'nullable|string',
                'other_prenom' => 'nullable|string',
                'other_tel' => 'nullable|string',
                'pays' => 'required|string',
                'cip' => 'required|string',
                'type_piece' => 'required',
                'quartier' => 'required|exists:quartiers,id',

            ]);



            $entreprise = Entreprise::create([
                'nom' => $data['nom_entrep'] ?? null, // `null` si aucune donnée
                'telephone' => $data['tel_entrep'] ?? null,
                'email' => $data['email'] ?? null,
                'reputation' => 5,
                'id_quartier' => $data['quartier'],
            ]);
            Log::info('Entreprise enregistrée:', $entreprise->toArray());
            $prestataire = Prestataire::create([
                'nom' => $data['nom_presta'],
                'prenom' => $data['prenom_presta'],
                'status' => null,
                'telephone' => $data['tel_presta'] ?? null,
                'id_entreprise' => $entreprise->id,
                'id_service' => $data['nom_service'],
                'pays' => $data['pays'],
                'cip' => $data['cip'],
                'id_piece' => $data['type_piece'],

            ]);
            Log::info('Prestataire enregistré:', $prestataire->toArray());

            user_prestataire::create([
                'user_id' => Auth()->user()->id,
                'prestataire_id' => $prestataire->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Prestataire enregistré avec succès!',
                'prestataire_id' => $prestataire->id
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement du prestataire:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue .' . $e->getMessage()
            ], 500);
        }
    }

    public function showProvider($id)
    {

        $prestataire = prestataire::findOrFail($id);

        // Si la requête ne contient pas de données de transaction, j'affiche simplement la page du prestataire
        return view('prestataires.showProvider', ['id' => $prestataire->id], compact('prestataire'));
    }

    public function updatePrestaire(Request $request)
    {
        try {
            $data = $request->validate([
                'prestataire_id' => 'required|exists:prestataires,id',
                'nom_position' => 'required|string',
                'long' => 'required|numeric',
                'lat' => 'required|numeric',
            ]);

            $prestataire = Prestataire::findOrFail($data['prestataire_id']);

            // Vérifier si la position existe déjà
            $position = Position::where('nom', $data['nom_position'])
                ->where('long', $data['long'])
                ->where('lat', $data['lat'])
                ->first();

            if (!$position) {
                // Créer une nouvelle position si elle n'existe pas
                $position = Position::create([
                    'nom' => $data['nom_position'],
                    'long' => $data['long'],
                    'lat' => $data['lat'],
                ]);
            }

            // Vérifier si le prestataire a déjà cette position
            $existingPosition = $prestataire->positions()->where('position_id', $position->id)->first();

            if (!$existingPosition) {
                // Ajouter la nouvelle position au prestataire
                $prestataire->positions()->attach($position->id);
                $message = 'Nouvelle position ajoutée pour le prestataire.';
            } else {
                $message = 'Le prestataire a déjà cette position.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'prestataire_id' => $prestataire->id,
                'position_id' => $position->id
            ], 200);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la position du prestataire:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editPrestataire($id)
    {

        $entreprises = Entreprise::all();
        $services = Service::all();

        $prestataire = prestataire::findOrFail($id);

        return view('commercials.updateProviderLoc', compact('prestataire', 'entreprises', 'services'));
    }

    public function editPrestaStandard($id)
    {
        $pieces = piece::all();
        $entreprises = Entreprise::all();
        $services = Service::all();

        $prestataire = prestataire::findOrFail($id);

        return view('commercials.updateStandardProvider.', compact('prestataire', 'entreprises', 'services', 'pieces'));
    }

    public function error()
    {
        return view('error');
    }
}
