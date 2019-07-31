<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Comprobante postulación</title>
</head>
<body>
    <p>¡Hola! {{$assistant->name}} Se ha registrado tu postulación a {{ $asignatura->name }}.</p>
    <p>Los datos con los que se registro tu postulación fueron:</p>
    <ul>
        <li>Nombre: {{ $assistant->name }}</li>
        <li>Teléfono: {{ $assistant->fone }}</li>
        
    </ul>
    <p>¡Gracias por postular!</p>
</body>
</html>