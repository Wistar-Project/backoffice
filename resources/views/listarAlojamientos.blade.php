<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h3>Lista de todos los alojamientos</h3>
        <table>
            <tr>
                <th>Id</th>
                <th>direccion</th>
                <th>tipo</th>
            </tr>
            @foreach($alojamientos as $alojamiento)
                <tr>
                    <td>{{$alojamiento['id']}}</td>
                    <td>{{$alojamiento['direccion']}}</td>
                    <td>{{$alojamiento['tipo']}}</td>
                </tr>
            @endforeach
        </table>
</body>
</html>