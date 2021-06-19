<?php

namespace App\Http\Controllers;
use App\Models\Ouvrages;
use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFOController extends Controller
{
     function index()
    {
     $ouvrage_data = $this->get_ouvrage_data();
     return view('dynamic_pdfo')->with('ouvrage_data', $ouvrage_data);
    }

    function get_ouvrage_data()
    {
     $ouvrage_data = DB::table('ouvrages')
         ->limit(10)
         ->get();
     return $ouvrage_data;
    }

    function pdfO()
    {
     $pdfo = \App::make('dompdf.wrapper');
     $pdfo->loadHTML($this->convert_ouvrage_data_to_html());
     return $pdfo->stream();
    }

    function convert_ouvrage_data_to_html()
    {
     $ouvrage_data = $this->get_ouvrage_data();
     $output = '
     <h3 align="center">ouvrage data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
     
       <th style="border: 1px solid; padding:12px;" width="15%">ID</th>
       <th style="border: 1px solid; padding:12px;" width="20%">type_ouvrage</th>
       <th style="border: 1px solid; padding:12px;" width="30%">code</th>
        <th style="border: 1px solid; padding:12px;" width="15%">date_edition</th>
       <th style="border: 1px solid; padding:12px;" width="20%">editeur</th>
       <th style="border: 1px solid; padding:12px;" width="20%">nbrpage</th>
        <th style="border: 1px solid; padding:12px;" width="15%">titre</th>
       <th style="border: 1px solid; padding:12px;" width="20%">annee_universitaire</th>
      
    
   </tr>
     ';  
     foreach($ouvrage_data as $ouvrage)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->type_ouvrage.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->code.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->date_edition.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->editeur.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->nbrpage.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->titre.'</td>
       <td style="border: 1px solid; padding:12px;">'.$ouvrage->annee_universitaire.'</td>
       
      
      
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }}
