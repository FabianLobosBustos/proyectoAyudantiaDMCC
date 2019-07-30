<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/theme/default.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <title>HOME</title>
  </head>
  <body >
  <div id="app">
  <div class="header row indigo darken-4">
    <div class="col s3 l2 offset-l9">
       <img  class="responsive-img" src="https://www.metalurgia.usach.cl/sites/metalurgica/files/uds_hcolor.png">
    </div>
  </div>
  
    @yield('content')
  </div>

  <script src="{{asset('js/app.js')}}"></script>
  
  </body>
</html>


