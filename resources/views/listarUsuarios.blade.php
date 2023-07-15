<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar usuarios</title>
</head>
    <body>
        <style>
            table{
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th{
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){
                background-color: #dddddd;
            }
        </style>
        <h3>Lista de todos los usuarios</h3>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
            @foreach($personas as $persona)
                <tr>
                    <td>{{ $persona["id"] }}</td>
                    <td>{{ $persona["nombre"]}}</td>
                    <td>{{ $persona["apellido"] }}</td>
                    <td>{{ $persona["email"]}}</td>
                    <td>{{ $persona["rol"]}}</td>
                </tr>

            @endforeach
        </table>
        <h3>Buscar un usuario específico</h3>
        <form action="/listar" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email del usuario a buscar">
            <input type="submit" value="Enviar">
        </form>
        @isset($personaEncontrada)
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
                <tr>
                    <td>{{ $personaEncontrada["id"] }}</td>
                    <td>{{ $personaEncontrada["nombre"] }}</td>
                    <td>{{ $personaEncontrada["apellido"] }}</td>
                    <td>{{ $personaEncontrada["email"] }}</td>
                    <td>{{ $personaEncontrada["rol"] }}</td>
                </tr>
            </table>
        @endisset
    </body>
</html>