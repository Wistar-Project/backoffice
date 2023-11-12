<x-header/>
<link rel="stylesheet" href="/styles/sedes.css">
<script src="/js/sedes.js" defer></script>

<h2 class="titulo">Sedes</h2>
@isset($mensaje)
    <x-alerta :color="$mensaje['color']">{{ $mensaje['texto'] }}</x-alerta>
@endisset
<main>
    <x-boton-volver/>
    <button type="button" id="boton-crear">Crear</button>
    <form id="creacion-popup" method="POST" action="/sedes">
        @csrf
        <div class="titulo-crear">
            <p>Crear sede</p>
            <img src="/img/cruz.png" alt="" width="20px" height="20px" id="cerrar-creacion">
        </div>
        <div class="inputs">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" minlength="10" maxlength="100" required>
        </div>
        <input type="submit" value="Crear">
    </form>
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