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
        <h3>Ingrese lote a buscar</h3>
        <form action="/verLote" method="get">
            @csrf
            <input type="number" name="id" placeholder="Id">
            <input type="submit" value="Buscar">
        </form>
        @isset($paquetes)
        <h2>El destino es: {{$destino}}</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Peso (kg)</th>
            </tr>
            @foreach($paquetes as $paquete)
            <tr>
                <th>{{$paquete["id"]}}</th>
                <th>{{$paquete["peso_en_kg"]}}</th>
            </tr>
            @endforeach
        </table>    
        @endisset
        @isset($mensaje)
            <p>{{$mensaje}}</p>
        @endisset
</body>
</html>