<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiquetes;
use DB;
class EtiquetesController extends Controller
{
    public function index()
    {
        $etiquetes = Etiquetes::select("*", DB::raw("CONCAT('E',etiquetes.num_etager,'-',etiquetes.num_rayon,'-',etiquetes.num_bloc) as emp"))
        ->get();
       
        return view('etiquete', compact('etiquetes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     Etiquetes::create([
            'num_etager' => $request->num_etager,           
            'num_rayon' => $request->num_etager,
            'num_bloc' => $request->num_bloc,
            'nbr_etiq' => $request->nbr_etiq

                    ]);

        return response()->json([
            'success' => 'etagerer saved successfully.',
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

    public function edit(Etiquetes $etiquete)
    {
//          $domaine = Domaines::find($id);
        return response()->json($etiquete);
    }

    public function update(Request $request, $id)
    {

        $v = Etiquetes::find($id);

        $v->num_etager =$request->num_etager;
        $v->num_rayon =$request->num_rayon;
        $v->num_bloc =$request->num_bloc;
        $v->emp =$request->emp;

       
        $v->save();
        return response()->json([
            'success' => true,
            'message' => 'update successfully'
        ]);
    }

   
    
    public function destroy(Etiquetes $etiquete)
    {
        $etiquete->delete();
        return redirect()->back()->with('success', 'etagere was deleted');
    }
}
