<x-header/>
<link rel="stylesheet" href="/styles/transporte.css">
<script src="/js/transporte.js" defer></script>

<h2 class="titulo" data-text-id="479">Vehículos</h2>
@isset($mensaje)
    <x-alerta :color="$mensaje['color']">{{ $mensaje['texto'] }}</x-alerta>
@endisset
<main>
    <x-boton-volver link="/"/>
    <button type="button" id="boton-crear" data-text-id="416">Crear</button>
    <form id="creacion-popup" method="POST" action="/transporte">
        @csrf
        <div class="titulo-crear">
            <p data-text-id="520">Crear vehículo</p>
            <img src="/img/cruz.png" alt="" width="20px" height="20px" id="cerrar-creacion">
        </div>
        <div class="inputs">
            <div>
                <label for="tipo" data-text-id="485">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="camion" data-text-id="512">Camión</option>
                    <option value="pickup">Pickup</option>
                </select>
            </div>
            <div>
                <label for="peso" data-text-id="522">Peso (t):</label>
                <input type="number" name="peso" id="peso" min="1" required>
            </div>
        </div>
        <button type="submit" data-text-id="416">Crear</button>
    </form>
    <div>
        <div id="mostrar-solo-boton">
            <div>
                <a href="/transporte" style="display:flex;justify-content:center;align-items:center;flex-direction:row;gap:10px">
                    <p data-text-id="483">Reiniciar filtro</p>
                    <img id="caret-mostrar-solo" src="/img/cruz.png" alt="">
                </a>
            </div>
        </div>
        <fieldset id="vehiculos-fieldset">
            <legend data-text-id="481">Camiones</legend>
            <div class="vehiculos-container">
                @foreach($camiones as $camion)
                    <form action="/transporte/{{$camion}}">
                        @csrf
                        <input type="submit" value="{{ $camion }}">
                    </form>
                @endforeach
            </div>
        </fieldset>
    </div>
    <fieldset id="info-fieldset">
        <legend data-text-id="484">Información del vehículo</legend>
        <ul>
    
                <li><span data-text-id="485">Tipo</span>:</li>
                <li><span data-text-id="487">Capacidad (t)</span>:</li>
                <li><span data-text-id="486">Conductor asignado</span>:</li>
        </ul>
        <p class="bolder" data-text-id="488">Lotes/Paquetes asignados</p>
        <div id="paquetes-o-lotes-container">

        </div>
        <button style="background-color: #313131">
            <img src="/img/eliminar.png" alt="">
            <p data-text-id="523">Eliminar vehículo</p>
        </button>
    </fieldset>
</main>
<x-footer/>