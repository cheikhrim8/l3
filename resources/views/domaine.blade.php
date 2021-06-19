@extends('layouts.app')
@section('content')

 <style type="text/css">
  #add-form{
     display:none;
  }
#none-btn{     display:none;
  }
</style>
    <div class="container">
<div >
    <section class="mt-5">
        <div>
        <button id="add-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-plus" > </span> <b>ajouter</b></button>
        <button id="none-btn" onclick="myFunction()" type="button"   class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-minus" > </span> <b>cacher</b></button>
    <a href="{{ url('dynamic_pdf/pdf') }}"  class=" btn btn-lg btn-primary">
                  <span class="glyphicon glyphicon-print" > </span> print </a>
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
                        <label for="u_nom">Nom:</label>
                        <input type="text" name="nom" id="u_nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="u_idParent"> domaine parent:</label>
                        <input type="text" name="idParent" id="u_idParent" class="form-control">
                    </div>
                    <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
        </div>

        <div id="add-form" >
                <div class="card" >
            <div class="card-header">
                <h4>add form</h4>
            </div>
            <div class="card-body">
                <form class ="add-form">
                           <div class="form-group">
                               <label for="nom">Nom</label>
                               <input type="text" name="nom" id="nom" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="idParent">IdParent</label>
<select name="idParent" id="idParent"  class="form-control" placeholder="Enter parent">
             @foreach($domaines as $domaine)
             <option value="{{$domaine->id}}">{{$domaine->id}}</option>
             @endforeach
             </select>                           </div>
                           <button type="submit" class="btn btn-lg btn-primary">enregistrer</button>
                       </form>
            </div>
        </div>
    </div>
 <div>
<div>
            &nbsp
        </div>
             <div class="card" >
        <table  id="myTable" class="table table-bordered data-table" width="100%">

            <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>domaine parent</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($domaines as $domaine)
                <tr>
                    <td>{{$domaine->id}}</td>
                    <td>{{$domaine->nom}}</td>
                    <td>{{$domaine->idParent}}</td>
                    <td>
                        <button class="edit-btn btn btn-lg btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>&nbsp <b>modifier</b>
                        </button>
                        &nbsp
                        <button
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{$domaine->id}}').submit();"
                            class="btn btn-lg btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp <b>supprimer</b>
                        </button>
                        <form action="{{route('domaines.destroy' , $domaine->id)}}"
                              id="delete-form-{{$domaine->id}}"
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
                let nom = row.find('td').eq(1).text()
                let idParent = row.find('td').eq(2).text()
                // $('.place-holder').replaceWith($('.edit-form').show())
                $('.edit-form').show()
                $('#u_nom').val(nom)
                $('#u_id').val(id)
                $('#u_idParent').val(idParent)
            })
         
            $('#edit-form').on('submit', function (e) {
                e.preventDefault()
                let id = $('#u_id').val()
                let _url = `domaines/${id}`
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
            // Add form logic
            $('.add-form').on('submit', function (e) {
                e.preventDefault()
                let _url = '{{route('domaines.store')}}'
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
