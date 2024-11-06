<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\CreditDemande;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CompteController extends Controller
{
    public function AfficherCompte()
    {
        $comptes = Compte::where('user_id', Auth::id())->where('status', 'approuvé')->get();
                return view('client.compte.index')->with('comptes',$comptes);

        
    }

    public function AjouterCompte(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'type' => 'required|in:PROFESSIONNELLE,BUSINESS,EPARGNE,PERSONNELLE',
        ]);
    
        do {
                // random_bytes(5) : Génère une chaîne de 5 octets (40 bits) aléatoires
                // bin2hex(...) : Convertit la chaîne binaire en une chaîne hexadécimale
            $num_compte = bin2hex(random_bytes(5));
        } while (Compte::where('num_compte', $num_compte)->exists());
            // Si un compte avec ce numéro existe, la boucle continue jusqu'à ce qu'un numero de compte unique soit genere

        $compte = new Compte;
        $compte->user_id = Auth::id();
        $compte->solde = 0;
        $compte->num_compte = $num_compte;
        $compte->libelle = $request->libelle;
        $compte->type = $request->type;
        $compte->status = 'en attente';
        $compte->save();
    
        return redirect()->back()->with('success', 'Demande de compte envoyée avec succès');
    }
    

    
    public function deposer(Request $request)
{
    // Valider la requête
    $request->validate([
        'montant' => 'required|numeric|min:1',
        'num_compte' => 'required',
    ]);

    // Trouver le compte correspondant au num_compte
    $compte = Compte::where('num_compte', $request->num_compte)->first();

    // Ajouter le montant au solde du compte
    $compte->solde += $request->montant;
    $compte->save();

    $operation = new Operation();
    $operation->compte_id = $compte->id;
    $operation->type = 'deposer';
    $operation->solde = $request->montant;
    $operation->save();

    // Rediriger l'utilisateur avec un message de succès
    return redirect()->back()->with('success', 'Dépôt effectué avec succès !');
}

public function retirer(Request $request)
{
    // Valider la requête
    $request->validate([
        'montant' => 'required|numeric|min:1',
        'num_compte' => 'required',
    ]);

    // Trouver le compte correspondant au num_compte
    $compte = Compte::where('num_compte', $request->num_compte)->first();

    // Vérifier si le solde du compte est suffisant
    if ($request->montant > $compte->solde) {
        return redirect()->back()->with('error', 'Solde insuffisant !');
    }

    // Soustraire le montant du solde du compte
    $compte->solde -= $request->montant;
    $compte->save();

    $operation = new Operation();
    $operation->compte_id = $compte->id;
    $operation->type = 'retirer';
    $operation->solde = $request->montant;
    $operation->save();
    

    // Rediriger l'utilisateur avec un message de succès
    return redirect()->back()->with('success', 'Retrait effectué avec succès !');
}
public function MouvementCompte($compte_id)
{
    $compte = Compte::find($compte_id);

    // Vérifiez si le compte appartient à l'utilisateur authentifié
    if ($compte->user_id != auth()->id()) {
        return redirect()->back()->with('error', 'Vous n\'avez pas la permission de voir les opérations de ce compte');
    }

    $data = collect();  // Get transactions where the compte is either the sender or the receiver


    // Sélectionner les transactions
    $transactions = Transaction::select(
        DB::raw("CASE
                    WHEN de_compte_id = $compte_id THEN 'Virement à '
                    WHEN a_compte_id = $compte_id THEN 'Transfer In'
                 END as operation"),
        'id as piece_number',
        'created_at as value_date',
        DB::raw("CASE WHEN a_compte_id = $compte_id THEN solde END as debit"),
        DB::raw("CASE WHEN de_compte_id = $compte_id THEN solde END as credit")
    )
    ->where(function ($query) use ($compte_id) {
         // ajoute une condition pour filtrer les transactions ou de_compte_id ou a_compte_id est égal à l'id du compte
        $query->where('de_compte_id', $compte_id)
              ->orWhere('a_compte_id', $compte_id);
    })
    ->get();
    
    // Sélectionner les demandes de crédit
    $creditDemandes = CreditDemande::select(
        DB::raw("'Crédit approuvé' as operation"),
        'id as piece_number',
        'created_at as value_date',
        DB::raw("NULL as debit"),
        DB::raw("
            CASE
                WHEN duree_remboursement BETWEEN 1 AND 7 THEN ROUND(solde * (0.05/12) / (1 - pow(1 + (0.05/12), - (duree_remboursement * 12))), 3)
                WHEN duree_remboursement BETWEEN 8 AND 14 THEN ROUND(solde * (0.06/12) / (1 - pow(1 + (0.06/12), - (duree_remboursement * 12))), 3)
                WHEN duree_remboursement BETWEEN 15 AND 24 THEN ROUND(solde * (0.07/12) / (1 - pow(1 + (0.07/12), - (duree_remboursement * 12))), 3)
            END as credit"),
        'status as type'
    )->where('compte_id', $compte_id)
     ->where('status', 'credit obtenu')
     ->get();
    
    // Sélectionner les opérations
    $operations = Operation::select(
        DB::raw("CASE
                    WHEN type = 'deposer' THEN 'Dépôt'
                    WHEN type = 'retirer' THEN 'Retrait'
                    ELSE 'Operation'
                 END as operation"),
        'id as piece_number',
        'created_at as value_date',
        DB::raw("CASE WHEN type = 'deposer' THEN solde ELSE NULL END as debit"),
        DB::raw("CASE WHEN type = 'retirer' THEN solde ELSE NULL END as credit"),
        'type'
    )->where('compte_id', $compte_id)// filtre les résultats par 'compte_id'
     ->whereIn('type', ['transfer', 'deposer', 'retirer'])
     ->get();
    
    // Combiner transactions, demandes de crédit et opérations
    $data = collect()->concat($transactions)->concat($creditDemandes)->concat($operations);
    
    // Trier les données par 'value_date'
    $data = $data->sortBy('value_date');
    
    return view('client.operations.operations', ['operations' => $data, 'compte' => $compte]);

}
}