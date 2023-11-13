<x-header/>
<link rel="stylesheet" href="/styles/lotes.css">
<x-boton-volver/>
<main>
    @isset($mensaje)
        <x-alerta :color="$mensaje['color']">{{$mensaje['texto']}} </x-alerta>
    @endisset
<fieldset id="container-lotes">
<legend>Lotes</legend>
</fieldset>
<fieldset id="informacion">

</fieldset>

</main>

@include('components/footer')
