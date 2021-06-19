<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exemplaires;
use Illuminate\Support\Facades\DB;

class ExemplairesController extends Controller
{
       public function index()
    {
        
        return view('exemplaire', [
            'exemplaires' => Exemplaires::all(),

        ]);


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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
       Exemplaires::create([
          'date_entree' => $request->date_entree,
        'id_ouvrage' => $request->id_ouvrage
                    ]);

        return response()->json([
            'success' => 'etagerer saved successfully.'
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

    public function edit(Exemplaires $exemplaire)
    {
//          $domaine = Domaines::find($id);

   
        return response()->json($exemplaire);
    }

    public function update(Request $request, $id)
    {

        $v = Exemplaires::find($id);


        $v->date_entree = $request->date_entree;
        $v->id_ouvrage = $request->id_ouvrage;

        $v->save();
        return response()->json([
            'success' => true,
            'message' => 'update successfully'
        ]);
    }

    public function destroy(Exemplaires $exemplaire)
    {

        $exemplaire->delete();

        return redirect()->back()->with('success', 'etagere was deleted');
    }
}
