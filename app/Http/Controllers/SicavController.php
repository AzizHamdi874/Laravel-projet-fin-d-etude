<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sicav;
class SicavController extends Controller{

    public function AfficherSicav(){
        $sicavs = Sicav::all();
        return view('admin.sicavs.index')->with('sicavs',$sicavs);
    }
    public function AfficageClientSicav(){
        $sicavs = Sicav::all();
        return view('client.sicav')->with('sicavs',$sicavs);
    }
    

    public function AjouterSicav(Request $request){
        
        
        
        
        
        
        $request->validate(
            ['type_sicav'=> 'required',
            'valeur_sicav'=> 'required',
            ]
        );
        $sicav = new Sicav();
        $sicav->type_sicav =$request->type_sicav;
        $sicav->valeur_sicav =$request->valeur_sicav;

        if($sicav->save()){
        return redirect()->back();
        }else {
            // Gérer l'erreur de manière appropriée, par exemple :
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
        }
    }

    public function SupprimerSicav($id){
        $sicav=Sicav::find($id);
        if($sicav->delete()){
            return redirect()->back();
        }else {
            // Gérer l'erreur de manière appropriée, par exemple :
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la supprision.');
        }
    }

    public function MajSicav(Request $request){
        $request->validate(
            [
            'valeur_sicav'=> 'required',
            ]
        );
        $id = $request->id_sicav;
        $sicav = Sicav::find($id);
        $sicav->valeur_sicav =$request->valeur_sicav;

        if($sicav->update()){
            return redirect()->back();
            }else {
                // Gérer l'erreur de manière appropriée, par exemple :
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
            }
    

}
}
