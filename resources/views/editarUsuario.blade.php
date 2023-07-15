<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar de usuarios</title>
</head>
<body>
    <form action="/editar" method="PUT">
        @csrf
        <input type="email" placeholder="Email del usuario a editar" name="email" required>
        <input type="text" placeholder="Nuevo nombre" name="nombre" required maxlength=50>
        <input type="text" placeholder="Nuevo apellido" name="apellido" required maxlength=50>
        <input type="password" placeholder="Nueva contraseña" name="contraseña" required>
    </form>
    @isset($usuarioEditado)
        <p>El usuario {{ $usuarioEditado }} ha sido editado satisfactoriamente.</p>
    @endisset
</body>
</html>