<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar alojamiento</title>
</head>
<body>
<form action="/borrarAlojamiento" method="post">
    @csrf 
    <input type="number" name="id" placeholder="Id del alojamiento" required>
    <input type="submit" value="Borrar">
</form>
@isset($mensaje)
    <p>{{$mensaje}}</p>
@endisset
</body>
</html>