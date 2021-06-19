<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afectations;
use DB;
use PDF;
class Dynamic_PDFAController extends Controller
{
    function index(){

       
        $afectation_data = $this->get_afectation_data();
        return view('dynamic_pdfa')->with('afectation_data', $afectation_data);
    }

    
    function get_afectation_data()
    {
     $afectation_data = DB::table('afectations')
         ->limit(10)
         ->get();
     return $afectation_data;
    }

    function pdfA()
    {
     $pdfa = \App::make('dompdf.wrapper');
     $pdfa->loadHTML($this->convert_afectation_data_to_html());
     return $pdfa->stream();
    }

    function convert_afectation_data_to_html()
    {
     $afectation_data = $this->get_afectation_data();
     $output = '
     <h3 align="center">Etiquete</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
     <tr>
     <th style="border: 1px solid; padding:12px;" width="15%">ID</th>
     <th style="border: 1px solid; padding:12px;" width="20%">Nom</th>
     <th style="border: 1px solid; padding:12px;" width="30%">etager</th>
     <th style="border: 1px solid; padding:12px;" width="30%">rayon</th>
     <th style="border: 1px solid; padding:12px;" width="30%">bloc</th>

 </tr>
      ';  
     foreach($afectation_data as $afectation)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$afectation->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$afectation->nom_dom.'</td>
       <td style="border: 1px solid; padding:12px;">'.$afectation->num_etager.'</td>
       <td style="border: 1px solid; padding:12px;">'.$afectation->num_rayon.'</td>
       <td style="border: 1px solid; padding:12px;">'.$afectation->num_bloc.'</td>

      
      
      
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

}
