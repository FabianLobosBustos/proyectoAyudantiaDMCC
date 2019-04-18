<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <title>HOME</title>
  </head>
  <body>
  <div class="header row indigo darken-4">
    <div class="col s6 m6 l6  valign-wrapper white-text">
      <p>Postulacion de Ayudantías</p>
    </div>
    <div class="col s6 l6 ">
       <img class="responsive-img" src="https://www.metalurgia.usach.cl/sites/metalurgica/files/uds_hcolor.png">
    </div>
  </div>
  
  offset-l6
    @yield('content')

  </body>
</html>

<style>
    div, .header{
      height: 29vh;
      font-size: 30px;
    }
    div, .insignia{
      height:20vh;
    }
</style>

