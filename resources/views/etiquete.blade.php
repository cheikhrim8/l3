
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
                      
       <a href="{{ url('dynamic_pdfet/pdfET') }}"  class=" btn btn-lg btn-primary">
                      <span class="glyphicon glyphicon-print" > </span> print </a>
            </div>
            <div>
                &nbsp
            </div>

         <div id="add-form" >
          <div class="card" >
            <div class="card-header">
                <h4> formulaire d'ajout</h4>
            </div>
            <div class="card-body" action="{{ route('etiquetes.store')}}" method="POST">
                <form class="add-form">
                    <div class="form-group">
                        <label for="a_code">num etager </label>
                        <input type="text" name="num_etager" id="num_etager" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="a_num_rayon">numero rayon</label>
                        <input type="text" name="num_rayon" id="num_rayon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="a_num_bloc">numero bloc</label>
                        <input type="text" name="num_bloc" id="num_bloc" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nbr_etiq">nombre etiquete</label>
                        <input type="text" name="nbr_etiq" id="nbr_etiq" class="form-control">
                    </div>
                    <button type="submit" id="submit-btn" class="btn btn-lg btn-primary">creer</button>
                </form>
            </div>
        </div>
         </div>
        <div class="card" >
            <table id="myTable" class="table table-bordered data-table" width="100%">
                <thead>
                <tr>
                    <th>id</th>
                    <th>etager</th>
                    <th>rayon</th>
                    <th>bloc</th>
                    <th>emp</th>
                    <th>nbr</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($etiquetes as $etiquete)
                    <tr>
                        <td>{{$etiquete->id}}</td>
                        <td>{{$etiquete->num_etager}}</td>
                            <td>{{$etiquete->num_rayon}}</td>
                        <td>{{$etiquete->num_bloc}}</td>
                        <td>{{$etiquete->emp}}</td>
                        <td>{{$etiquete->nbr_etiq}}</td>

                        <td>
                            
                             <button class="edit-btn btn btn-lg btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp <b>modifier</b>
                            </button>
                            &nbsp
                            
                            <button
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $etiquete->id}}').submit();"
                                class="btn btn-lg btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>&nbsp <b>supprimer</b>
                            </button>
                            <form action="{{route('etiquetes.destroy' , $etiquete->id)}}"
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

            

         $('.add-form').on('submit', function (e) {
                e.preventDefault()
                let _url = '{{route('etiquetes.store')}}'
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