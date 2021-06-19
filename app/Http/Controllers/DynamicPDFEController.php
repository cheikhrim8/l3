<?php

namespace App\Http\Controllers;
use App\Models\Etageres;

use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFEController extends Controller
{
     function index()
    {
     $etagere_data = $this->get_etagere_data();
     return view('dynamic_pdfe')->with('etagere_data', $etagere_data);
    }

    function get_etagere_data()
    {
     $etagere_data = DB::table('etageres')
         ->limit(10)
         ->get();
     return $etagere_data;
    }

    function pdfE()
    {
     $pdfe = \App::make('dompdf.wrapper');
     $pdfe->loadHTML($this->convert_etagere_data_to_html());
     return $pdfe->stream();
    }

    function convert_etagere_data_to_html()
    {
     $etagere_data = $this->get_etagere_data();
     $output = '
     <h3 align="center">etagere data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
     
       <th style="border: 1px solid; padding:12px;" width="15%">codeE</th>
       <th style="border: 1px solid; padding:12px;" width="20%">num_rayon</th>
       <th style="border: 1px solid; padding:12px;" width="30%">num_bloc</th>
        
      
    
   </tr>
     ';  
     foreach($etagere_data as $etagere)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$etagere->codeE.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etagere->num_rayon.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etagere->num_bloc.'</td>
      
      
      
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }}
