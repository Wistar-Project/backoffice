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

</fieldset>

</main>

@include('components/footer')
