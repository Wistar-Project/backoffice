<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Agregar un paquete a un lote:</h3>
    <form action="/agregarPaqueteALote" method="post">
        @csrf
        <input type="number" name="idPaquete" placeholder="Id de paquete">
        <input type="number" name="idLote" placeholder="Id de lote">
        <input type="submit" value="Agregar">
    </form>
    @isset($mensajeEnAgregar)
    <p>{{$mensajeEnAgregar}}</p>
    @endisset
    <h3>Agregar un paquete a un lote</h3>
    <form action="/removerPaqueteALote" method="post">
        @csrf
        <input type="number" name="idPaquete" placeholder="Id de paquete">
        <input type="number" name="idLote" placeholder="Id de lote">
        <input type="submit" value="Remover">
    </form>
    @isset($mensajeEnRemover)
    <p>{{$mensajeEnRemover}}</p>
    @endisset
</body>
</html>