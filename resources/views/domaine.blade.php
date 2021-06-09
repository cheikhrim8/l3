@extends('layouts.app')
@section('content')

    <section class="mt-5">

        <div class="container mb-5">
            <div class="edit-form" style="display: none">
                <div class="card">
                    <div class="card-header">
                        <h4>edit form</h4>
                    </div>
                    <div class="card-body">
                        <form id="edit-form">
                            {{--                    <input type="text" id="u_id">--}}
                            <div class="form-group">
                                <label for="u_nom">Nom</label>
                                <input type="text" name="nom" id="u_nom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="u_idParent">Nom</label>
                                <input type="text" name="idParent" id="u_idParent" class="form-control">
                            </div>
                            <button type="submit" id="submit-btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       <div class="container mb-5">
           <div class="add-form">
               <div class="card">
                   <div class="card-header">
                       <h4>edit form</h4>
                   </div>
                   <div class="card-body">
                       <form id="add-form">
                           <div class="form-group">
                               <label for="nom">Nom</label>
                               <input type="text" name="nom" id="nom" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="idParent">IdParent</label>
                               <input type="text" name="idParent" id="idParent" class="form-control">
                           </div>
                           <button type="submit" class="btn btn-primary">Save changes</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>

        <div class="container">

            <button id="add" type="button" class="btn btn-primary my-4">Add</button>

            <table id="myTable" class="table table-bordered data-table" width="100%">
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
                            <button class="edit-btn btn btn-sm btn-primary">edit</button>
                            <button
                                onclick="event.preventDefault(); confirm(document.getElementById('delete-form').submit());"
                                class="btn btn-sm btn-danger">delete
                            </button>
                            <form action="{{route('domaines.destroy' , $domaine->id)}}"
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

            $('#add-form').on('submit', function (e) {
                e.preventDefault()

                let _url = '{{route('domaines.store')}}'
                $.ajax({
                    type: 'post',
                    url: _url,
                    data: $('#add-form').serialize(),
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
@endsection
