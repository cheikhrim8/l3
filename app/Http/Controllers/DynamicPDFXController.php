<?php

namespace App\Http\Controllers;
use App\Models\Exemplaires;
use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFXController extends Controller
{
  function index()
    {
     $exemplaire_data = $this->get_exemplaire_data();
     return view('dynamic_pdfx')->with('exemplaire_data', $etagere_data);
    }

    function get_exemplaire_data()
    {
     $exemplaire_data = DB::table('exemplaires')
         ->limit(10)
         ->get();
     return $exemplaire_data;
    }

    function pdfX()
    {
     $pdfX = \App::make('dompdf.wrapper');
     $pdfX->loadHTML($this->convert_exemplaire_data_to_html());
     return $pdfX->stream();
    }

    function convert_exemplaire_data_to_html()
    {
     $exemplaire_data = $this->get_exemplaire_data();
     $output = '
     <h3 align="center">Exemplaire data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
     
       <th style="border: 1px solid; padding:12px;" width="15%">date_entree</th>
       <th style="border: 1px solid; padding:12px;" width="20%">id_ouvrage</th>
       
        
      
    
   </tr>
     ';  
     foreach($exemplaire_data as $exemplaire)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$exemplaire->date_entree.'</td>
       <td style="border: 1px solid; padding:12px;">'.$exemplaire->id_ouvrage.'</td>
       
      
      
      
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
}
