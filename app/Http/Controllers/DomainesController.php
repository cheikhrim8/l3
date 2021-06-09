<?php

namespace App\Http\Controllers;

use App\Models\Domaines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DomainesController extends Controller
{

    public function index()
    {
        /* $domaines = Domaines::latest()->get();

        if ($request->ajax()) {
            $data = Domaines::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook"><span class="glyphicon glyphicon-pencil"></span></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook"><span class="glyphicon glyphicon-trash"></span></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('domaine',compact('domaines')) ;*/

        return view('domaine', [
            'domaines' => Domaines::all(),

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

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Domaines::create([
            'nom' => $request->nom,
            'idParent' => $request->idParent
        ]);

        return response()->json([
            'success' => 'domaine saved successfully.'
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

    public function edit(Domaines $domaine)
    {
//          $domaine = Domaines::find($id);
        return response()->json($domaine);
    }

    public function update(Request $request, $id)
    {

        $v = Domaines::find($id);

        $this->validate($request, [
            'nom' => ['required']
        ]);

        $v->nom = $request->nom;
        $v->idParent = $request->idParent;

        $v->save();
        return response()->json([
            'success' => true,
            'message' => 'update successfully'
        ]);
    }

    public function destroy(Domaines $domaine)
    {

        $domaine->delete();

        return redirect()->back()->with('success', 'domaine was deleted');
    }
}

