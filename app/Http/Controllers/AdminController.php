<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\CreditDemande;
use App\Models\Bbe;
use App\Models\Sicav;
use App\Models\Compte;
use App\Models\Operation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller
{
    //
    public function Statistique (){
        $count = User::where('role', 'user')->count();
        $totCreditApp = CreditDemande::where('status', 'credit obtenu')->count();
        $totCreditAtt = CreditDemande::where('status', 'en attente')->count();
        $totCreditNonApp = CreditDemande::where('status', 'credit non obtenu')->count();
        $activer = User::where('is_active',1)->count();
        $pourcentageActiver = $count != 0 ? ($activer/$count)*100 : 0;        // Récupérer le nombre d'utilisateurs inscrits chaque jour
        $userParJour = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->get()
        ->toArray();
    
        // Convertir les dates en labels et les comptes en données pour le graphique
        $jours = array_column($userParJour, 'date');
        $userTotal = array_column($userParJour, 'total');
    
    
        
            // Récupérer les types d'opérations et leur nombre
            $operations = Operation::whereIn('type', ['credit_demande', 'transfer in'])
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get()
            ->toArray();
    
        // Convertir les types en labels et les totaux en données pour le graphique
        $labels = array_map(function($type) {
            if ($type == 'credit_demande') {
                return 'Crédits ';
            } elseif ($type == 'transfer in') {
                return 'Transactions';
            }
        }, array_column($operations, 'type'));
    
        $data = array_column($operations, 'total');
    
    
          $bbes = Bbe::all()->count();
          $sicavs= Sicav::all()->count();
        /*$labels = $bbes->pluck('code_titre');
        $data_cours = $bbes->pluck('valeur_cours');
        $data_plh_cours = $bbes->pluck('plh_cours');
        $data_plb_cours = $bbes->pluck('plb_cours');*/
    
        $totalUser = User::where('role', 'user')->count();
        $totalCompte = Compte::count();
        $moyCompteParUser = $totalUser != 0 ? $totalCompte / $totalUser : 0;
    
        return view('admin.dashboard', compact('count','bbes','sicavs', 'totCreditApp','totCreditAtt','totCreditNonApp', 'operations', 'labels', 'data','moyCompteParUser','pourcentageActiver','jours','userTotal'));
    }

    public function Profile(){
        return view('admin.profile');
    }

    public function MajProfile(Request $request){
        //dd($request);
        if(empty($request->name) || empty($request->email)) {
            return redirect('/admin/profile')->with('error','Le nom et l\'email ne peuvent pas être vides');
        }
    
        if(!empty($request->password) && strlen($request->password) < 8) {
            return redirect('/admin/profile')->with('error','Le mot de passe doit contenir au moins 8 caractères ');
        }
        Auth::user()->name=$request->name;
        Auth::user()->prenom=$request->prenom;
        Auth::user()->email=$request->email;
        $nv_nom=uniqid();
        $image = $request->file('image');

        if ($image) {
            $nv_nom .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $nv_nom);
            Auth::user()->image = $nv_nom;
        }
        if($request->password){
            Auth::user()->password=Hash::make($request->password);
        }
        Auth::user()->update();
         return redirect('/admin/profile')->with('success','Admin modifier avec succés');



    }



    public function AfficherClient(){
        $clients = User::where('role', 'user')->get();
        return view('admin.clients.index')->with('clients',$clients);
    }

    public function BloquerClient($id){
        $client = User::find($id);
        $client->is_active = false;
        $client->save();
        return redirect()->back()->with('success', 'Client bloqué');
    }


    public function ActiverClient($id){
        $client = User::find($id);
        $client->is_active = true;
        $client->save();
        return redirect()->back()->with('success', 'Client activé');
    }
    

    public function AjouterClient(Request $request){
        
        $request->validate(
            ['name'=> 'required',
            'prenom'=> 'required',
            'email'=> 'required|unique:users,email',
            'password'=> 'required',
            ]
        );
        $user = new User();
        $user->name =$request->name;
        $user->prenom =$request->prenom;
        $user->email =$request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->numero_user = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);

        $nv_nom = uniqid();

        $image = $request->file('image');
        
        if ($image) {
            $nv_nom .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $nv_nom);
            $user->image = $nv_nom;
        } else {

            $user->image = '65fb7f683dde8.png';
            //dd($user->image);
        }
        
        if ($user->save()) {
            return redirect()->back()->with('success', ' User ajouté avec succès');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
        }
        
    }

    public function SupprimerClient($id){
        $user=User::find($id);
        if($user->delete()){
            return redirect()->back()->with('error', 'User supprimé avec succès.');
        }else {
            // Gérer l'erreur de manière appropriée, par exemple :
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression.');
        }
    }

    public function MajClient(Request $request){
        $request->validate(
            ['name'=> 'required',
            'prenom'=> 'required',
            ]
        );
        $id= $request->id_client;
        $user=User::find($id);
        $user->name =$request->name;
        $user->prenom =$request->prenom;
        $user->role = $request->role;
         if($request->password){
            $user->password = Hash::make($request->password);
        }

        if($request->file('image')) {
            if($user->image) {
                $file_path = public_path().'/uploads/'.$user->image;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            $nv_nom=uniqid();
            $image =$request->file('image');
            $nv_nom.=".".$image->getClientOriginalExtension();
            $destinationPath='uploads';
            $image->move($destinationPath , $nv_nom);
            $user->image=$nv_nom;
        }
        

        if($user->update()){
            return redirect()->back()->with('success', 'Votre user modifié avec succées');
            }else {
                // Gérer l'erreur de manière appropriée, par exemple :
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
            }

    }
    public function ChercherUser(Request $request)
    {
        $clients = User::where('role', 'user')
        ->where('name', 'LIKE', '%' . $request->name . '%')
        ->get();

        return view('admin.clients.index')->with('clients', $clients);
    }



    public function AfficherCreditAdmin()
    {
        $creditDemandes = CreditDemande::all();

        return view('admin.admin', ['creditDemandes' => $creditDemandes]);
    }

    public function ApproverCredit(Request $request, CreditDemande $creditDemande)
    {
        $creditDemande->status = $request->input('status');
        $creditDemande->save();
    
       
        if ($creditDemande->status == 'credit obtenu') {
            $duree = $creditDemande->duree_remboursement;
        
            if ($duree >= 1 && $duree <= 7) {
                $interet = 0.05;
            } elseif ($duree >= 8 && $duree <= 14) {
                $interet = 0.06;
            } elseif ($duree >= 15 && $duree <= 24) {
                $interet = 0.07;
            } 
        
            $creditSolde = ($creditDemande->solde * ($interet / 12)) / (1 - pow(1 + ($interet / 12), - ($duree * 12)));
        
        
                $compte = $creditDemande->compte;
                $compte->solde -= $creditSolde;
                $compte->save();
                return redirect()->back()->with('success', 'Le compte est apprové avec succés');
        }else if ($creditDemande->status == 'credit non obtenu') {
            return redirect()->back()->with('error', 'Le compte n\'est pas apprové');
         }else{
            return redirect()->back()->with('error', 'Veuillez sélectionner d\'abord');
         }
    }
    public function AfficherTransactions()
{
    $transactions = Transaction::all(); // 

    return view('admin.transactions', compact('transactions'));
}

public function ChercherTransactions(Request $request)
{
    $query = Transaction::query();
    if ($request->filled('from_num_compte')) {
        // si le parameetre est present on va ajouter une clause de jointure pour filtrer les resultat en fonction de la relation fromCompte
        $query->whereHas('fromCompte', function ($query) use ($request) {
            $query->where('num_compte', 'like', '%' . $request->input('from_num_compte') . '%');
        });
    }

    if ($request->filled('to_num_compte')) {
        $query->whereHas('toCompte', function ($query) use ($request) {
            $query->where('num_compte', 'like', '%' . $request->input('to_num_compte') . '%');
        });
    }

    if ($request->filled('montant')) {
        $query->where('solde', $request->input('montant'));
    }

    $transactions = $query->get();

    return view('admin.transactions', compact('transactions'));
}

public function ChercherStatus(Request $request)
{
    $status = $request->input('status');

    $creditDemandes = CreditDemande::when($status, function ($query, $status) {
        return $query->where('status', $status);
    })->get();

    return view('admin.admin', ['creditDemandes' => $creditDemandes]);
}

public function ApproverCompte($id)
{
    $compte = Compte::find($id);

    if ($compte) {
        $compte->status = 'approuvé';
        $compte->num_compte = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $compte->save();

        return redirect()->back()->with('success', 'Compte approuvé avec succès');
    } else {
        return redirect()->back()->with('error', 'Compte non trouvé');
    }
}
public function AfficherCompte()
{
    $comptes = Compte::all();

    return view('admin.compte.index', compact('comptes'));
}

    


}
