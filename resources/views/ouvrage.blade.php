@extends('layouts.app')
@section('content')

<style type="text/css">
  #add-form{
     display:none;
  }
   #none-btn{ display:none; }
   #emp-form{ display:none; }

</style>
    <div class="container">

    <section class="mt-5">
   <div>
        <button id="add-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-plus-sign" > </span> <b>ajouter</b></button>
        <button id="none-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-minus-sign" > </span> <b>cacher</b></button>
                  <a href="{{ url('dynamic_pdfo/pdfO') }}"  class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-print" > </span> print </a>
 <div>
            &nbsp
        </div>

        </div>
        <div id="emp-form" >
          <div class="card">
            <div class="card-header">
                <h4>emp form</h4>
            </div>
            <div class="card-body">
                <form class="edit-form">
                    <input type="hidden" id="e_id">
                    <div class="form-group">
                        <label for="e_nom_dom">Domaine</label>
                        <input type="text" name="nom_dom" id="e_nom_dom" class="form-control">
                    </div>
                     <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">enregistrer</button>
                </form>
            </div>
        </div>
    </div>
        <div>
            &nbsp
        </div>
    <div class="edit-form" style="display: none">
          <div class="card">
            <div class="card-header">
                <h4>edit form</h4>
            </div>
            <div class="card-body">
                <form id="edit-form">
                    <input type="hidden" id="u_id">
                    <div class="form-group">
                        <label for="u_nom_dom">Domaine</label>
                        <input type="text" name="nom_dom" id="u_nom_dom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_type_ouvrage">type_ouvrage</label>
                        <input type="text" name="type_ouvrage" id="u_type_ouvrage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_code">code</label>
                        <input type="text" name="code" id="u_code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_date_edition">date d'edition</label>
                        <input type="text" name="date_edition" id="u_date_edition" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_editeur">Editeur</label>
                        <input type="text" name="editeur" id="u_editeur" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="u_nbrpage">nombre page</label>
                        <input type="text" name="nbrpage" id="u_nbrpage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_titre">Titre</label>
                        <input type="text" name="titre" id="u_titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_annee_universitaire">annee_universitaire</label>
                        <input type="text" name="annee_universitaire" id="u_annee_universitaire" class="form-control">
                    </div>
                    
                    <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">enregistrer</button>
                </form>
            </div>
        </div>
    </div>
<div class="container mb-5">
           <div id="add-form" >
            <div class="card">
            <div class="card-header">
                <h4>add form</h4>
            </div>
            <div class="card-body">
                <form class="add-form" >
                     <div class="form-group">
                        <label for="nom_dom">Domaine</label>
                        <input type="text" name="nom_dom" id="nom_dom" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="type_ouvrage">type_ouvrage</label>
                        <input type="text" name="type_ouvrage" id="type_ouvrage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="code">code</label>
                        <input type="text" name="code" id="code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_edition">date d'edition</label>
                        <input type="text" name="date_edition" id="date_edition" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editeur">Editeur</label>
                        <input type="text" name="editeur" id="editeur" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="nbrpage">nombre page</label>
                        <input type="text" name="nbrpage" id="nbrpage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="annee_universitaire">annee_universitaire</label>
                        <input type="text" name="annee_universitaire" id="annee_universitaire" class="form-control">
                    </div>
                     
                           <button type="submit" class="btn btn-lg btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
 <div>
    <div>
            &nbsp &nbsp
        </div>
    
                        <div class="card">
        <table  id="myTable" class="table table-bordered data-table" width="100%">
            <thead>
            <tr>
    
                <th>id</th> 
                <th>domaine</th> 
                <th>type d'ouvrage </th>
                <th>code </th>
                <th>date d'edition</th>
                <th>Editeur</th>
                <th>nombre page</th>
                <th>Titre</th>
                <th>annee universitaire</th>
                <th>emp</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($ouvrages as $ouvrage)
                <tr>
                    <td>{{$ouvrage->id}}</td>
                    <td>{{$ouvrage->nom_dom}}</td>
                     <td>{{$ouvrage->type_ouvrage}}</td>
                    <td>{{$ouvrage->code}}</td>
                    <td>{{$ouvrage->date_edition}}</td>
                    <td>{{$ouvrage->editeur}}</td>
                    <td>{{$ouvrage->nbrpage}}</td>
                    <td>{{$ouvrage->titre}}</td>
                    <td>{{$ouvrage->annee_universitaire}}</td>
                    <td>{{$ouvrage->emp}}</td>

                    <td>
                    
                         <button class="edit-btn btn btn-lg btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>                         </button>
                        <button
                            onclick="event.preventDefault(); confirm(document.getElementById('delete-form').submit());" class="btn btn-lg btn-danger">
                            <span class="glyphicon glyphicon-trash"></span> 
                        </button>
                        <form action="{{route('ouvrages.destroy' , $ouvrage->id)}}"
                              id="delete-form" method="post" style="display: none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No record</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


    </section>
@stop


@section('js')

    <script type="text/javascript">
        $(document).ready(function () {

            $('#myTable').DataTable({
                "language": {
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sLast": "Dernier",
                        "sPrevious": "Precedent",
                        "sNext": "Suivant",
                    }
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Edit logic
            $('.edit-btn').on('click', function (e) {
                e.preventDefault()

                let row = $(this).closest('tr')
                let nom_dom = row.find('td').eq(1).text()
                let id = row.find('td').eq(0).text()           
                let type_ouvrage = row.find('td').eq(2).text()
                let code = row.find('td').eq(3).text()
                let date_edition = row.find('td').eq(4).text()
                let editeur = row.find('td').eq(5).text()
                let nbrpage = row.find('td').eq(6).text()
                let titre = row.find('td').eq(7).text()
                let annee_universitaire = row.find('td').eq(8).text()

                // $('.place-holder').replaceWith($('.edit-form').show())
                $('.edit-form').show()

                $('#u_id').val(id)                 
                $('#u_nom_dom').val(nom_dom)
                 $('#u_type_ouvrage').val(type_ouvrage)
                $('#u_code').val(code) 
                $('#u_date_edition').val(date_edition)
                 $('#u_editeur').val(editeur)
                 $('#u_nbrpage').val(nbrpage)
                 $('#u_titre').val(titre)
                 $('#u_annee_universitaire').val(annee_universitaire)


            })

            $('#edit-form').on('submit', function (e) {
                e.preventDefault()

                let id = $('#u_id').val()

                let _url = `ouvrages/${id}`
                $.ajax({
                    url: _url,
                    type: 'put',
                    // contentType: 'json',
                    data: $("#edit-form").serialize(),
                    success: function (response) {
                        console.log(response)
                        window.location.reload()
                    },
                    error: function (err) {
                        console.log(err)
                        window.location.reload()
                    }
                })
              })
        $('.add-form').on('submit', function (e) {
                e.preventDefault()
                let _url = '{{route('ouvrages.store')}}'
                $.ajax({
                    type: 'post',
                    url: _url,
                    data: $('.add-form').serialize(),
                    success: function (res) {
                        console.log(res)
                        //window.location.reload()
                    },
                    error: function (err) {
                        console.error(err)
                       // window.location.reload()
                    }
                })
            })

 $('.emp-btn').on('click', function (e) {
                e.preventDefault()

                let row = $(this).closest('tr')
                let nom_dom = row.find('td').eq(1).text()

                $('#emp-form').show()

                $('#e_nom_dom').val(nom_dom)
               

            })

            $('.emp-form').on('submit', function (e) {
                e.preventDefault()

                let nom_dom = $('#e_nom_dom').val()

                let _url = `ouvrages/${nom_dom}`
                $.ajax({
                    url: _url,
                   type: 'post',
                    // contentType: 'json',
                    data: $(".emp-form").serialize(),
                    success: function (response) {
                        console.log(response)
                        window.location.reload()
                    },
                    error: function (err) {
                        console.log(err)
                        window.location.reload()
                    }
                })
            })
        })
  function myFunction() {
   var x =document.getElementById("add-form");
     if(x.style.display=="none"){
      x.style.display="block";
     }
     else {
       x.style.display="none";
     }
     }

  function myFunction() {
   var x =document.getElementById("add-form");
      var y =document.getElementById("add-btn");
      var z =document.getElementById("none-btn");

     if(x.style.display=="none"){
      x.style.display="block";
            y.style.display="none";
      z.style.display="block";

     }
     else {
       x.style.display="none";
                   y.style.display="block";
                         z.style.display="none";
     }
     }


</script>
@endsection