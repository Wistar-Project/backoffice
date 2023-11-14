<x-header/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/styles/lotes.css">
<x-boton-volver/>
<main>
    @isset($mensaje)
        <x-alerta :color="$mensaje['color']">{{$mensaje['texto']}} </x-alerta>
    @endisset
<fieldset id="container-lotes">
<legend>Lotes</legend>
@foreach($lotes as $lote)
    <button type="button" class="boton-lotes" data-id="{{ $lote['id'] }}">{{ $lote['id'] }}</button>
@endforeach
</fieldset>
<fieldset id="informacion">
<legend>Informacion del lote</legend>
<div id="texto">
    <p>Peso(kg):</p>
    <p>Destino:</p>
    <p>Fecha de modificación:</p>
</div>
<fieldset id="paquetes">
    <legend>Paquetes asignados</legend>
</fieldset>
    <button type="button" id="eliminar-boton">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
        </svg>
        Eliminar Lote
    </button>


</fieldset>

</main>
<script src="/js/lotes.js"></script>
@include('components/footer')
