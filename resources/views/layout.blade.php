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
    <div id="app">
  <div class="header row indigo darken-4">
    <div class="col  s2 ">
       <img  class="responsive-img" src="https://www.metalurgia.usach.cl/sites/metalurgica/files/uds_hcolor.png">
    </div>
    <div class="col  s2 offset-s8">
       <img  class="responsive-img dmcc" src="../../images/dmccfinal2.png">
    </div>
  </div>
  </head>
  <body >
  
  
    @yield('content')
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <script src="{{asset('js/app.js')}}"></script>
  
  </body>
</html>

<style scoped>
.dmcc{
  width: 150px; 
  height: 150px;
  padding-top: 10px;
}
</style>
