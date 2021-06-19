<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Afectations;

class AfectationsController extends Controller
{

    public function index()
    {
       
        return view('afectation', [
            'afectations' => Afectations::all(),

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
    public function store(Request $request)
    {


     Afectations::create([
            'nom_dom' => $request->nom_dom, 
            'num_etager' => $request->num_etager,           
            'num_rayon' => $request->num_rayon,
            'num_bloc' => $request->num_bloc,
            'statu' => $request->statu

                    ]);
    // $a = new Afectations();
    // $a->nom_dom =  $request->nom_dom;
    // $a->num_etager = $request->num_etager;
    // $a->num_rayon = $request->num_rayon;
    // $a->num_bloc = $request->num_bloc;
    // $a->statu = $request->statu;

    //                 $a->save();
    

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

    public function edit(Afectations $afectation)
    {
//          $domaine = Domaines::find($id);
        return response()->json($afectation);
    }

    public function update(Request $request, $id)
    {

        $v = Afectations::find($id);

        $v->nom_dom =$request->nom_dom;
        $v->num_etager =$request->num_etager;
        $v->num_rayon =$request->num_rayon;
        $v->num_bloc =$request->num_bloc;
        $v->statu =$request->statu;

       
        $v->save();
        return response()->json([
            'success' => true,
            'message' => 'update successfully'
        ]);
    }

    public function act($id){

        $afectations=Afectations::all();

   foreach (afectations as $afectation){
       if($afectation->statu== 1 && $afectation->nom_dom=$nm) {
       $afectation->statu=0;}
        }
        $v = Afectations::find($id);
        $nm= $v->nom_dom;
        $v->statu=1;
        $v->save();  

        return redirect()->back()->with('success', 'activation');

    }
    
    public function destroy(Afectations $afectation)
    {
        $etagere->delete();
        return redirect()->back()->with('success', 'etagere was deleted');
    }
}
