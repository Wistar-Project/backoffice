<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar conductor a vehículo</title>
</head>
<body>
    <form action="/asignarConductor" method="POST">
        @csrf
        <input type="text" placeholder="Id del conductor" name="id_conductor" required>
        <input type="text" placeholder="Id del vehículo" name="id_vehiculo" required>
        <input type="submit" value="Asignar">
    </form>
    @isset($mensaje)
        <p>{{ $mensaje }}</p>
    @endisset
</body>
</html>