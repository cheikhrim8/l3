<!DOCTYPE html>
<html>
 <head>
  <title>Laravel - How to Generate Dynamic PDF from HTML using DomPDF</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Laravel - How to Generate Dynamic PDF from HTML using DomPDF</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Ouvrage Data</h4>
    </div>
    <div class="col-md-5" align="right">
     <a href="{{ url('dynamic_pdfo/pdfO') }}" class="btn btn-danger">Convert into PDF</a>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>ID</th>
       <th>type_ouvrage</th>
       <th>code</th>
       <th>date_edition</th>
       <th>editeur</th>
       <th>nbrpage</th>
       <th>titre</th>
       <th>annee_universitaire</th>
       
      </tr>
     </thead>
     <tbody>
     @foreach($ouvrage_data as $ouvrage)
      <tr>
       <td>{{ $ouvrage->id }}</td>
       <td>{{ $ouvrage->type_ouvrage }}</td>
       <td>{{ $ouvrage->code }}</td>
        <td>{{ $ouvrage->date_edition}}</td>
       <td>{{ $ouvrage->editeur }}</td>
       <td>{{ $ouvrage->nbrpage}}</td>
       <td>{{ $ouvrage->titre }}</td>
       <td>{{ $ouvrage->annee_universitaire}}</td>
       
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>