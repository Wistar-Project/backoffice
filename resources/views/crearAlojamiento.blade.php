<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/crearAlojamiento" method="post">
        @csrf
        <input type="text" name="direccion" placeholder="Ingrese la direccion" required>
        <select name="tipo" >
            <option value="sede">sede</option>
            <option value="almacen">almacén</option>
        </select>
        <input type="submit" value="Crear">
    </form>
    @isset($mensaje)
        <p>{{$mensaje}}</p>
    @endisset
</body>
</html>