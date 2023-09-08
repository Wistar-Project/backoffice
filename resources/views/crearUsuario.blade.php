<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de usuarios</title>
</head>
<body>
    <form action="/crear" method="POST">
        @csrf
        <input type="text" placeholder="Nombre" name="nombre" required maxlength=50>
        <input type="text" placeholder="Apellido" name="apellido" required maxlength=50>
        <input type="email" placeholder="Email" name="email" required>
        <select name="rol" required>
            <option value="administrador">Administrador</option>
            <option value="conductor">Conductor</option>
            <option value="funcionario">Funcionario</option>
        </select> 
        <input type="password" placeholder="Contraseña" name="password" required>
        <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" required>
        <input type="submit" value="Registrar">
    </form>
    @isset($mensaje)
        <p>{{ $mensaje }}</p>
    @endisset
</body>
</html>