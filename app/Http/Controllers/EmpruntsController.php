<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\emprunts;

class EmpruntsController extends Controller
{
    public function emprunts(){
        //équivaut à select * from emprunts;
        $emprunts=emprunts::all();
        
        
        //renvoie vers la vue listeemprunts
            return view('listeemprunts',compact('emprunts'));
        
    }
    public function create(){
        return view('create');
    }

    public function enregistrement(Request $request){
        $emprunts =new emprunts;
        $emprunts->id_ouvrage = $request->ouvrage;
        $emprunts->id_utilisateur = $request->utilisateur;
        $emprunts->date_emprunt = $request->date_emprunt;
        $emprunts->date_retour_prevue = $request->date_retour_prevue;
        $emprunts->date_retour_reel = $request->date_retour_reel;
        $emprunts->save();
        return redirect()->route('emprunts');
    }

    public function suppression($ouvrage){
        
        $emprunts= emprunts::find($ouvrage);
        $emprunts->delete();

        return redirect('/emprunt')->with('status','Emprunt supprimé');
    }

    public function update($ouvrage){
        $emprunts = emprunts::find($ouvrage);  
        return view('update', compact('emprunts')); 
    }

    public function update_enregistrement(Request $request){
        //système de validation pour que tous les champs soient saisis
        $request->validate([
            'date_emprunt'=>'required',
        ]);
        
        $emprunts= emprunts::find($request->id);
        
        $emprunts->date_emprunt = $request->date_emprunt;
        $emprunts->save();

        return redirect('/emprunt')->with('status','Emprunt modifiée');
    }

    // EmpruntController.php

    public function edit($id_emprunt)
    {
        $emprunts = emprunts::find($id_emprunt);  
        return view('update', compact('emprunts')); 
    }

}
