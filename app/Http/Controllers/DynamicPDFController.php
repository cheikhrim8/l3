<?php

namespace App\Http\Controllers;
use App\Models\Domaines;
use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
    function index()
    {
     $domaine_data = $this->get_domaine_data();
     return view('dynamic_pdf')->with('domaine_data', $domaine_data);
    }

    function get_domaine_data()
    {
     $domaine_data = DB::table('domaines')
         ->limit(10)
         ->get();
     return $domaine_data;
    }

    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_domaine_data_to_html());
     return $pdf->stream();
    }

    function convert_domaine_data_to_html()
    {
     $domaine_data = $this->get_domaine_data();
     $output = '
     <h3 align="center">domaine data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
       <th style="border: 1px solid; padding:12px;" width="15%">ID</th>
       <th style="border: 1px solid; padding:12px;" width="20%">Nom</th>
       <th style="border: 1px solid; padding:12px;" width="30%">idParent</th>
    
   </tr>
     ';  
     foreach($domaine_data as $domaine)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$domaine->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$domaine->nom.'</td>
       <td style="border: 1px solid; padding:12px;">'.$domaine->idParent.'</td>
      
      
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }}
