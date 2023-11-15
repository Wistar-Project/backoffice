<x-header/>
<link rel="stylesheet" href="/styles/transporte.css">
<script src="/js/transporte.js" defer></script>

<h2 class="titulo">Vehículos</h2>
@isset($mensaje)
    <x-alerta :color="$mensaje['color']">{{ $mensaje['texto'] }}</x-alerta>
@endisset
<main>
    <x-boton-volver link="/"/>
    <button type="button" id="boton-crear">Crear</button>
    <form id="creacion-popup" method="POST" action="/transporte">
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
                <input type="number" name="peso" id="peso" min="1" required>
            </div>
        </div>
        <input type="submit" value="Crear">
    </form>
    <div>
        <div id="mostrar-solo-boton">
            <div>
                <a href="/transporte" style="display:flex;justify-content:center;align-items:center;flex-direction:row;gap:10px">
                    <p>Reiniciar filtro</p>
                    <img id="caret-mostrar-solo" src="/img/cruz.png" alt="">
                </a>
            </div>
        </div>
        <fieldset id="vehiculos-fieldset">
            <legend>Pickups</legend>
            <div class="vehiculos-container">
                @foreach($pickups as $pickup)
                    <form action="/transporte/{{$pickup}}">
                        @csrf
                        <input type="submit" value="{{ $pickup }}">
                    </form>
                @endforeach
            </div>
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
        <div id="paquetes-o-lotes-container">

        </div>
        <button style="background-color: #313131">
            <img src="/img/eliminar.png" alt="">
            <p>Eliminar vehículo</p>
        </button>
    </fieldset>
</main>
<x-footer/>