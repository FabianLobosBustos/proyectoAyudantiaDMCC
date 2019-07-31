<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Comprobante postulación</title>
</head>
<body>
    <p>¡Hola! {{$assistant->name}}, se ha registrado tu postulación a {{ $asignatura->name }} en el periodo {{$phase->semester}}/{{$phase->year}}.</p>
    <p>Los datos con los que se registró tu postulación fueron:</p>
    <ul>
        <li>Nombre: {{ $assistant->name }}</li>
        <li>Apellidos: {{ $assistant->lastNameDad}} {{$assistant->lastNameMom}}</li>
        <li>Rut: {{ $assistant->rut }} - {{$assistant->verificatorDigit}}</li>
        <li>Email: {{ $assistant->email }}</li>
        <li>Teléfono: {{ $assistant->fone }}</li>
        <li>Address: {{ $assistant->address }}</li>
        <li>Profesor de referencia: {{ $postulation->referenceText }}</li>
        <!--{{$i=0}}-->
        @foreach($requirementSendArray as $requirement)
            <li>Nota {{$requirement['name']}}: {{$assistantScoreSendArray[$i]}}</li>
            <!--{{$i++}}-->
        @endforeach
        <li>PPA: {{ $assistant->ppa }}</li>
   </ul>
    <p>¡Gracias por postular!</p>
</body>
</html>