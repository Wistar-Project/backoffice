<x-header/>
<link rel="stylesheet" href="/styles/transporte.css">
<script src="/js/sedes.js" defer></script>
<script src="/js/transporte.js" defer></script>

<h2 class="titulo">Vehículos</h2>
@isset($mensaje)
    <x-alerta :color="$mensaje['color']">{{ $mensaje['texto'] }}</x-alerta>
@endisset
<main>
    <x-boton-volver/>
    <button type="button" id="boton-crear">Crear</button>
    <form id="creacion-popup" method="POST" action="/sedes">
        @csrf
        <div class="titulo-crear">
            <p>Crear vehículo</p>
            <img src="/img/cruz.png" alt="" width="20px" height="20px" id="cerrar-creacion">
        </div>
        <div class="inputs">
            <div>
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="camion">Camión</option>
                    <option value="pickup">Pickup</option>
                </select>
            </div>
            <div>
                <label for="peso">Peso (t):</label>
                <input type="text" name="peso" id="peso" required>
            </div>
        </div>
        <input type="submit" value="Crear">
    </form>
    <div>
        <div id="mostrar-solo-boton">
            <div>
                <p>Mostrar solo...</p>
                <img id="caret-mostrar-solo" src="/img/caret-abajo.png" alt="">
            </div>
            <button>Camiones</button>
            <button>Pickups</button>
        </div>
        <fieldset>
            <legend>Vehículos</legend>
        </fieldset>
    </div>
    <fieldset id="info-fieldset">
        <legend>Información del vehículo</legend>
        <ul>
            <div>
                <li>Tipo:</li>
                <li>Capacidad (t):</li>
            </div>
            <li>Conductor asignado:</li>
        </ul>
        <p class="bolder">Lotes/Paquetes asignados</p>
        <div id="paquetes-o-lotes-container"></div>
        <button>
            <img src="/img/eliminar.png" alt="">
            <p>Eliminar vehículo</p>
        </button>
    </fieldset>
</main>
<x-footer/>