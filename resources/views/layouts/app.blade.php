<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Crud operation using ajax(Real Programmer)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
</head>
<body style="height: 100vh">

<nav class="navbar shadow navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="./"><b>EtiquetageBiblio</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./domaines">Domaine <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active" >
                    <a class="nav-link" href="./ouvrages">Ouvrage</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./etageres">Etagere</a>
                </li>
              
                <li class="nav-item active">
                    <a class="nav-link " href="./exemplaires">Exemplaire</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="./afectations">Emplacement</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="./etiquetes">Etiquete</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<div class="">
    @yield('content')
</div>

<script src="{{mix('js/app.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@yield('js')
</body>
</html>
