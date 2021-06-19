<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ouvrages;
use App\Models\Afectations;
use DB;
class OuvragesController extends Controller
{

    public function index()
    {  

    $ouvrages = Ouvrages::all();
  
        return view('ouvrage', ['ouvrages' => $ouvrages]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {

    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {   
    	$ouvrages= Ouvrages::all();

   $nm=$request->nom_dom;

            $l= DB::table("afectations")
->select(DB::raw(" distinct afectations.num_etager,afectations.num_rayon ,afectations.num_bloc "))
->join('ouvrages','ouvrages.nom_dom','=','afectations.nom_dom')
->where([['statu','=',1] ,['afectations.nom_dom','=','$nm']]) 
->get()  ;
     
    $k=(string) ($l[0]->num_etager.'-'.$l[0]->num_rayon.'-'. $l[0]->num_bloc);


        Ouvrages::create([
        	      'nom_dom'=> $request->nom_dom,
                 'type_ouvrage' => $request->type_ouvrage,
                 'code'=> $request->code,
                 'date_edition' => $request->date_edition,
                 'editeur'=> $request->editeur,
                'nbrpage' => $request->nbrpage,
                'titre'=> $request->titre,
                 'annee_universitaire' => $request->annee_universitaire,
                 'emp'  => $k         
                 ]); 

    return response()->json([
            'success' => ' ouvrage saved successfully.'
        ]);     
  }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

    }

    public function edit(Ouvrages $ouvrage)
    {
//          $domaine = Domaines::find($id);
        return response()->json($ouvrage);
    }

    public function update(Request $request, $id)
    {

        $v = Ouvrages::find($id);
                   $v->nom_dom = $request->nom_dom;
            $v->type_ouvrage = $request->type_ouvrage;
            $v->code = $request->code;
            $v->date_edition = $request->date_edition;
            $v->editeur = $request->editeur;
                $v->nbrpage = $request->nbrpage;
                $v->titre = $request->titre;
                 $v->annee_universitaire = $request->annee_universitaire;

        $v->save();
        return response()->json([
            'success' => true,
            'message' => 'update successfully'
        ]);
    }

    public function destroy(Ouvrages $ouvrage)
    {

        $ouvrage->delete();

        return redirect()->back()->with('success', 'ouvrage was deleted');
    }
}


