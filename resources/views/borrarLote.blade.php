<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar lote</title>
</head>
<body>
     
<form action="/borrarLote" method="post">
    @csrf 
    <input type="text" name="idLote" placeholder="Id del lote" required>
    <input type="submit" value="Borrar">
</form>
@isset($mensaje)
    <p>{{$mensaje}}</p>
@endisset
</body>
</html>