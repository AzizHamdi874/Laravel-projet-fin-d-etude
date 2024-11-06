<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bbe;

class BbeController extends Controller
{
    //
    public function AfficherBbes(){
        $bbes = Bbe::all();
        return view('admin.bbes.index')->with('bbes',$bbes);
    }
    public function AfficageClientBbes(){
        $bbes = Bbe::all();
        return view('client.bbe')->with('bbes',$bbes);
    }

    
    

    public function AjouterBbes(Request $request){  
        $request->validate(
            ['designation'=> 'required',
            'code'=> 'required',
            'unite'=> 'required',
            'achat'=> 'required',
            'vente'=> 'required',]
        );
        $bbe = new Bbe();
        $bbe->designation =$request->designation;
        $bbe->code =$request->code;
        $bbe->unite =$request->unite;
        $bbe->achat =$request->achat;
        $bbe->vente =$request->vente;
        $nv_nom = uniqid();

        $image = $request->file('image');
        
        if ($image) {
            $nv_nom .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $nv_nom);
            $bbe->image = $nv_nom;
        }

        if($bbe->save()){
        return redirect()->back()->with('success', 'Cours de la bourse ajouté .');;
        }else {
            // Gérer l'erreur de manière appropriée, par exemple :
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
        }
    }

    public function SupprimerBbes($id){
        $bbe=Bbe::find($id);
        if($bbe->delete()){
            return redirect()->back();
        }else {
            // Gérer l'erreur de manière appropriée, par exemple :
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
        }
    }

    public function MajBbes(Request $request){
        $request->validate(
            [
            'unite'=> 'required',
            'achat'=> 'required',
            'vente'=> 'required',]
        );
        $id= $request->id_bbe;
        $bbe=Bbe::find($id);
        $bbe->unite =$request->unite;
        $bbe->achat =$request->achat;
        $bbe->vente =$request->vente;
        if($request->file('image')) {
            if($bbe->image) {
                $file_path = public_path().'/uploads/'.$bbe->image;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            $nv_nom=uniqid();
            $image =$request->file('image');
            $nv_nom.=".".$image->getClientOriginalExtension();
            $destinationPath='uploads';
            $image->move($destinationPath , $nv_nom);
            $bbe->image=$nv_nom;
        }
        

        if($bbe->update()){
            return redirect()->back()->with('success', 'Cours de la bourse changé .');
            }else {
                // Gérer l'erreur de manière appropriée, par exemple :
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la sauvegarde.');
            }

    }
}
