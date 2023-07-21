<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Lotes</title>
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
        <h3>Lista de todos los paquetes</h3>
        <table>
            <tr>
                <th>Id</th>
                <th>peso en kg</th>
                <th>destino</th>
            </tr>
            @foreach($paquetes as $paquete)
                <tr>
                    <td>{{$paquete['id']}}</td>
                    <td>{{$paquete['peso_en_kg']}}</td>
                    <td>{{$paquete['destino']}}</td>
                </tr>
            @endforeach
        </table>
</body>
</html>