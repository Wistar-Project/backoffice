<x-header/>
<link rel="stylesheet" href="/styles/sedes.css">
<h2 class="titulo">Sedes</h2>
@isset($errorOcurrido)
    <x-alerta>{{ $errorOcurrido }}</x-alerta>
@endisset
<main>
    <x-boton-volver/>
    <button type="button" id="boton-buscar">Crear</button>
    <fieldset>
        <legend>Sedes</legend>
        @foreach($sedes as $sede)
            <form class="sede-container" method="POST" action="/sedes/{{ $sede -> id }}">
                @csrf
                @method('DELETE')
                <input type="submit" value="">
                <p>{{ $sede -> alojamiento -> direccion }}</p>
            </form>
        @endforeach
    </fieldset>
</main>
<x-footer/>