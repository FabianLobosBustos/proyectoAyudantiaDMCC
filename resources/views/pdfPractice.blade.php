@extends('layout')
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.table-condensed{
  font-size: 10px;
}

</style>
</head>
<body>

<h2>Postulaciones - {{$data[0]['subject_name']}} - Segundo Semestre 2019</h2>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<table class="table table-condensed">
  <tr>
    <th>Rut</th>
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Email</th>
    <!--<th>Telefono</th>-->
    <!--<th>Dirección</th>-->
    <!--<th>Facultad</th>-->
    <th>Carrera</th>
    <th>PPA</th>
    <th>Nivel</th>
    @foreach ($data[0]['requirements_subject'] as $requirement)
    <th>{{$requirement['requirement_name']}}</th>  
    @endforeach
  </tr>
  @foreach ($data[0]['assistants'] as $value)
  <tr>
      <td>{{$value['assistant_rut']}}</td>
      <td>{{$value['assistant_name']}}</td>
      <td>{{$value['assistant_lastNameDad']}}</td>
      <td>{{$value['assistant_lastNameMom']}}</td>
      <td>{{$value['assistant_email']}}</td>
      <td>{{$value['career_name']}}</td>
      <td>{{$value['assistant_ppa']}}</td>
      <td>{{$value['assistant_level']}}</td>
      @foreach ($value['scores'] as $score)
      <td>{{$score['score']}}</td>   
      @endforeach
  </tr>
  @endforeach
</table>

</body>
</html>
