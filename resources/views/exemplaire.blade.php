
@extends('layouts.app')
@section('content')

   <style type="text/css">
 #add-form{  display:none;}
 #none-btn{ display:none; }
</style>
    <div class="container">
<div >

    <section class="mt-5">
        <div>
        <button id="add-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-plus" > </span> <b>ajouter</b></button>
        <button id="none-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-minus" > </span> <b>cacher</b></button>
<a href="{{ url('dynamic_pdfx/pdfX') }}"  class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-print" > </span> print </a>
        </div>
        <div>
            &nbsp
        </div>
    <div class="edit-form" style="display: none">
          <div class="card" >
            <div class="card-header">
                <h4>Formulaire de modification</h4>
            </div>
            <div class="card-body">
                <form id="edit-form">
                    <input type="hidden" id="u_id">
                    <div class="form-group">
                        <label for="u_id_ouvrage">id ouvrage</label>
                        <input type="text" name="id_ouvrage" id="u_id_ouvrage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_date_entree">date entree</label>
                        <input type="text" name="date_entree" id="u_date_entree" class="form-control">
                    </div>
                    
                    <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

         <div id="add-form" >
          <div class="card" >
            <div class="card-header">
                <h4> formulaire d'ajout</h4>
            </div>
            <div class="card-body" >
                <form class="add-form">
                 <div class="form-group">
                        <label for="id_ouvrage">id ouvrage</label>
                        <input type="text" name="id_ouvrage" id="id_ouvrage" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_entree">date entree</label>
                        <input type="text" name="date_entree" id="date_entree" class="form-control">
                    </div>
                   
                    <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">creer</button>
                </form>
            </div>
        </div>
    </div>
 <div>
            &nbsp
        </div>
    
                        <div class="card" >
        <table id="myTable" class="table table-bordered data-table" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id ouvrage</th>
                <th>date d'entre</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($exemplaires as $exemplaire)
                <tr>
                    <td>{{$exemplaire->id}}</td>
                    <td>{{$exemplaire->id_ouvrage}}</td>                    
                    <td>{{$exemplaire->date_entree}}</td>
    
                    <td>
                         <button class="edit-btn btn btn-lg btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>&nbsp <b>modifier</b>
                        </button>
                        &nbsp
                        <button
                            onclick="event.preventDefault(); confirm(document.getElementById('delete-form').submit());"
                            class="btn btn-lg btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp <b>supprimer</b>
                        </button>
                        <form action="{{route('exemplaires.destroy' , $exemplaire->id)}}"
                              id="delete-form"
                              method="post" style="display: none">
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
                let id = row.find('td').eq(0).text()
                let date_entree = row.find('td').eq(2).text()
                let id_ouvrage = row.find('td').eq(1).text()


                // $('.place-holder').replaceWith($('.edit-form').show())
                $('.edit-form').show()

                $('#u_date_entree').val(date_entree)
                $('#u_id').val(id)
                $('#u_id_ouvrage').val(id_ouvrage)

            })
         
    $('#edit-form').on('submit', function (e) {
                e.preventDefault()
                let id = $('#u_id').val()
                let _url = `exemplaires/${id}`
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
                let _url = '{{route('exemplaires.store')}}'
                $.ajax({
                    type: 'post',
                    url: _url,
                    data: $('.add-form').serialize(),
                    success: function (res) {
                        console.log(res)
                        window.location.reload()
                    },
                    error: function (err) {
                        console.log(err)
                        window.location.reload()
                    }
                })
            })
        })


    </script>
     <script type="text/javascript">
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