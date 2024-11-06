<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CreditDemande;


class SimulationController extends Controller
{
    public function AfficherSimulation()
    {
        return view('client.simulation');
    }

    public function Simulation(Request $request)
    {
        // Récupérer les données du formulaire
        $montantCredit = $request->input('montant_credit');
        $durreRembourssement = $request->input('durre_rembourssement');
        $salaireMensuel = $request->input('salaire_mensuel');

        // Effectuer les calculs pour obtenir la mensualité
        // Ici, nous supposons un taux d'intérêt variable de 5% ou 6 ou 7 par an
        $duree = $durreRembourssement;

        if ($duree >= 1 && $duree <= 7) {
            $interetAnnuel = 0.05;
        } elseif ($duree >= 8 && $duree <= 14) {
            $interetAnnuel = 0.06;
        } elseif ($duree >= 15 && $duree <= 24) {
            $interetAnnuel = 0.07;
        } 
        
        $interetMensuel = $interetAnnuel / 12;
        $numPayment = $duree * 12;
        
        if((1 - pow(1 + $interetMensuel, -$numPayment)) != 0) {
            $paymentMensuel = ($montantCredit * $interetMensuel) / (1 - pow(1 + $interetMensuel, -$numPayment));
        } else {
            // Gérer l'erreur, peut-être définir $paymentMensuel a une valeur par défaut ou lancer une exception
            $paymentMensuel = 0; // ou une autre valeur par default
        }
        
        


        // calculer le montant maximum du credit 40% du revenu mensuel brut
        $paymentMensuelParDinar =( $salaireMensuel * 0.4) ;
        $maxMontantCredit =($paymentMensuelParDinar * $durreRembourssement*12);

        // Calculer la mensualité par dinar

        // Passer les résultats à la vue
        $results = [
            'payment_mensuel' => round($paymentMensuel, 3),
            'max_montant_credit' => round($maxMontantCredit, 3),
            'payment_mensuel_par_dinar' => round($paymentMensuelParDinar, 3)
        ];

        return view('client.simulation', compact('results', 'montantCredit', 'durreRembourssement', 'salaireMensuel')); 
       }


}
