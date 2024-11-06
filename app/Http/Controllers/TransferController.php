<?php

namespace App\Http\Controllers;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;
use App\Models\CreditDemande;
use App\Models\Operation;
use Illuminate\Support\Facades\DB;
use App\Notifications\TransferSucces;
use App\Notifications\TransferDestination;

class TransferController extends Controller
{
    public function Transfer(Request $request)
{
    $request->validate([
        'de_num_compte' => 'required',
        'a_num_compte' => 'required',
        'solde' => 'required|numeric|between:5,500',
        'otp' => 'required',
    ]);

    // trouver le compte à partir duquel le transfert est effectue
    //first ici retourne le premier resultat du query 
    $fromCompte = Compte::where('num_compte', $request->input('de_num_compte'))->first();

    // Trouver le compte vers lequel le transfert est effectué
    $toCompte = Compte::where('num_compte', $request->input('a_num_compte'))->first();

    $solde = $request->input('solde');

    // Vérifier si les comptes existent
    if (!$fromCompte || !$toCompte) {
        return redirect()->back()->with('error', 'Aucun compte trouvé avec ce numéro');
    }

    // Vérifier si le mot de passe est correct
    // Récupère une instance du service Google2FA via le conteneur de services de Laravel
    $google2fa = app('pragmarx.google2fa');
    $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $request->input('otp'));
    if (!$valid) {
        return redirect()->back()->with('error', 'OTP incorrect');
    }

    // Vérifier si le solde du compte est suffisant
    if ($solde > $fromCompte->solde) {
        return redirect()->back()->with('error', 'Solde insuffisant');
    }
    // Vérifier si les comptes sont différents
if ($request->input('de_num_compte') == $request->input('a_num_compte')) {
    return redirect()->back()->with('error', 'Vous ne pouvez pas transférer de l\'argent à votre propre compte');
}


    try {
        // Effectuer le transfert
        $fromCompte->solde -= $solde;
        $toCompte->solde += $solde;
        $fromCompte->save();
        $toCompte->save();


                // Enregistrer la transaction
        $transaction = new Transaction();
       /* $transaction->de_user_id = auth()->id();
        $transaction->a_user_id = $toCompte->user->id;*/ 
        $transaction->de_compte_id = $fromCompte->id;
        $transaction->a_compte_id = $toCompte->id;
        $transaction->solde = $solde;
        $transaction->save();

    // Enregistrer l'opération pour le compte d'origine
        $operation = new Operation();
        $operation->compte_id = $fromCompte->id; 
       /* $operation->user_id = auth()->id();*/
        $operation->type = 'transfer out';
        $operation->solde = $solde;
        $operation->save();

        // Enregistrer l'opération pour le compte de destination
        $operation = new Operation();
        $operation->compte_id = $toCompte->id; 
        /*$operation->user_id = $toCompte->user->id;*/
        $operation->type = 'transfer in';
        $operation->solde = $solde;
        $operation->save();
//l'envoie du mail au destinataire
        $toCompte->user->notify(new TransferDestination($transaction));
//l'envoie du mail au expiditeur
        auth()->user()->notify(new TransferSucces($transaction));
        return redirect()->back()->with('success', 'Transfert réussi');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    public function AfficherTransfer()
    {
        return view('client.transfer');
    }

    public function AfficherTransactions()
    {
        $user = Auth::user();
        $transactions = collect(); //  creation d'une liste vide pour recuperre les transactions
    
        foreach ($user->comptes as $compte) {
            $transactions = $transactions->concat($compte->transactions);
        }
    
        return view('client.transactions', ['transactions' => $transactions]);
    }
    
    

    

}
