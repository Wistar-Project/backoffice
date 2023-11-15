<x-header/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/styles/lotes.css">
<x-boton-volver link="/paqueteria" />
<main>
    @isset($mensaje)
        <x-alerta :color="$mensaje['color']">{{$mensaje['texto']}} </x-alerta>
    @endisset
<fieldset id="container-lotes">
<legend data-text-id="411">Lotes</legend>
@foreach($lotes as $lote)
    <button type="button" class="boton-lotes" data-id="{{ $lote['id'] }}">{{ $lote['id'] }}</button>
@endforeach
</fieldset>
<fieldset id="informacion">
<legend data-text-id="453">Informacion del lote</legend>
<div id="texto">
    <p data-text-id="420">Peso(kg):</p>
    <p data-text-id="425">Destino:</p>
    <p data-text-id="430">Fecha de modificación:</p>
</div>
<fieldset id="paquetes">
    <legend data-text-id="457">Paquetes asignados</legend>
</fieldset>
    <div id="botones">
    <button type="button" id="eliminar-boton" data-text-id="473">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
        </svg>
        Eliminar Lote
    </button>
    <button type="button" id="asignar-boton" data-text-id="427">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
  <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
</svg>    
    Asignar
    </button>
    </div>
</fieldset>
<fieldset id="container-asignar">
<svg id="close-window" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>

    @foreach ($camiones as $camion)
        <button id="boton-camion" data-id="{{ $camion['id'] }}">{{ $camion['id'] }}</button>
    @endforeach
</fieldset>

</main>
<script src="/js/lotes.js"></script>
@include('components/footer')
