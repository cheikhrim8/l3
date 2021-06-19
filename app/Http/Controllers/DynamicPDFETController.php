<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiquetes;
use DB;
use PDF;
class DynamicPDFETController extends Controller
{

    function index(){

     $etiquete_data = $this->get_etiquete_data();
     return view('dynamic_pdfet')->with('etiquete_data', $etiquete_data);
    }

    function get_etiquete_data()
    {
    	$etiquete_data = Etiquetes::all();
         
    	foreach($etiquete_data as $etiquete){
    		
     $etiquete_data = Etiquetes::select("*", DB::raw("CONCAT('E',num_etager,'-',num_rayon,'-',num_bloc) as emp"))
         ->limit(10)->get();
         $etiquete->delete();
         }

     return $etiquete_data;
    }

    function pdfET()
    {
     $pdfet = \App::make('dompdf.wrapper');
     $pdfet->loadHTML($this->convert_etiquete_data_to_html());
     return $pdfet->stream();
    }

    function convert_etiquete_data_to_html()
    {
     $etiquete_data = $this->get_etiquete_data();
     $output = '
     <h3 align="center">Etiquete</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      
     ';  
     foreach($etiquete_data as $etiquete)
     {for ($i = 1; $i <= $etiquete->nbr_etiq/4; $i++) {
     	
      $output .= ' 
    <tr>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
      </tr>
      '; }
    
    $l=$etiquete->nbr_etiq%4;
      if ($l==1) {
     	
      $output .= ' 

    <tr>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
      </tr>
      '; }

      $l=$etiquete->nbr_etiq%4;
      if ($l==2) {
     	
      $output .= ' 
     
    <tr>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>

      
      </tr>
      '; }

      $l=$etiquete->nbr_etiq%4;
      if ($l==3) {
     	
      $output .= ' 
     
    <tr>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>
       <td style="border: 1px solid; padding:12px;">'.$etiquete->emp.'</td>

      
      </tr>
      '; }
     
     $output .= '</table>';

     return $output;
    }
}
}

