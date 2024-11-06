<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditDemande;
use App\Models\Operation;


class CreditController extends Controller
{
    public function AfficherDemandeCredit() // Formulaire de demande un credit de type get de données
{
    $comptes = auth()->user()->comptes;
    return view('client.demandeCredit', compact('comptes'));
}

public function AjouterDemandeCredit(Request $request)// Ajouter les valeurs nécessaires pour que ajouter un demande credit avec post
{
    

        $validatedData = $request->validate([
            'compte_id' => 'required|not_in:0',
            'solde' => 'required|numeric|between:1500,100000',
            'duree_remboursement' => 'required|numeric|between:3,30',
            'revenu_mensuel' => 'required|numeric|between:550,3300',
        ]);
    
        $creditDemande = new CreditDemande([
            'compte_id' => $validatedData['compte_id'],
            'solde' => $validatedData['solde'],
            'duree_remboursement' => $validatedData['duree_remboursement'],
            'revenu_mensuel' => $validatedData['revenu_mensuel'],
            'status' => 'en attente',
        ]);
    
        $creditDemande->save();
    
    
    // Enregistrer l'opération
    $operation = new Operation();
    $operation->compte_id = $request->input('compte_id'); // Set the compte_id field
    /*$operation->user_id = auth()->id();*/
    $operation->type = 'credit_demande';
    $operation->solde = $request->input('solde');
    $operation->save();

    return redirect()->back()->with('success', 'Credit ajouté');
}



public function AfficherEspaceCredit()
{
    // Initialise une nouvelle collection vide pour stocker les crédits demandés
    $creditDemandes = collect();

    foreach (auth()->user()->comptes as $compte) {
        // Fusionne les crédits demandés du compte actuel avec la collection principale
        $creditDemandes = $creditDemandes->merge($compte->creditDemandes);
    }

    return view('client.espaceDemandeCredit', ['creditDemandes' => $creditDemandes]);
}




}
