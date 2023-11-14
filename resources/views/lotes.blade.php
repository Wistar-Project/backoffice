<x-header/>
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
    <p>Destino :</p>
    <p>Fecha de modificacion</p>
</div>
<fieldset id="paquetes">
    <legend>Paquetes asignados</legend>
</fieldset>
</fieldset>

</main>
<script src="/js/lotes.js"></script>
@include('components/footer')
