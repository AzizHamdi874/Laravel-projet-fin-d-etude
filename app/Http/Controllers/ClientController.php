<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compte;
use App\Models\Transaction;
use App\Models\CreditDemande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    //
    
    
    public function DashboardClient (){
        $user_id = Auth::id();
        $comptes = Compte::where('user_id', $user_id)->get();
    
        $count = $comptes->where('status', 'approuvé')->count();
        $totsolde = $comptes->sum('solde');
    
        $transaction = 0;
        foreach ($comptes as $compte) {
            $transaction += Transaction::where('de_compte_id', $compte->id)->count();
            $transaction += Transaction::where('a_compte_id', $compte->id)->count();
        }

        $totalCreditDemande = 0;
foreach ($comptes as $compte) {
    $totalCreditDemande += CreditDemande::where('compte_id', $compte->id)->count();
}
    
        return view('client.dashboard',compact('count','totsolde','transaction','totalCreditDemande'));
    }
    
    


   public function afficherMessageBlocker(){
    return view('client.bloquer');
   }



}
