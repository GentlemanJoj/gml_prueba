<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a GMLPrueba</title>
</head>
<body>
    <h3>Hola Administrador</h3>
	<p>A continuación, el reporte de usuarios por país:</p>
    
    @foreach($usuarios as $usuario)
        <p> {{$usuario->pais . " - " . $usuario->total}}</p>
    @endforeach
</body>
</html>