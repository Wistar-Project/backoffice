<x-header/>
<link rel="stylesheet" href="/styles/paquetes.css">
<x-boton-volver/>
<main>
    <fieldset id="container-paquetes">
        <legend>Paquetes</legend>
        @foreach($paquetes as $paquete)
            <button type="button" data-id="{{ $paquete['id'] }}" class="boton-paquete">{{ $paquete['id'] }}</button>
        @endforeach 
    </fieldset>
    <fieldset id="informacion">
        <legend>Informacion del paquete</legend>
        <p>Peso(kg):</p>
        <p>Destino:</p>
        <p>Fecha de creacion:</p>
        <p>Vehiculo asignado:</p>
        <p>Lote asignado:</p>
    </fieldset>
</main>
<script src="/js/paquetes.js"></script>
<x-footer/>