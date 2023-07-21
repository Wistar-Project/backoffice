<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/borrarPaquete" method="post">
    @csrf 
    <input type="text" name="id" placeholder="Id del paquete" required>
    <input type="submit" value="Borrar">
</form>
@isset($mensaje)
    <p>{{$mensaje}}</p>
@endisset
</body>
</html>