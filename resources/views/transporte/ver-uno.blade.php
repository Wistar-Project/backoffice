<x-header/>
<link rel="stylesheet" href="/styles/transporte.css">
<script src="/js/transporte.js" defer></script>
<script src="/js/transporte-menu-mostrar-solo.js" defer></script>
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
                    <option value="camion" data-text-id="521">Camión</option>
                    <option value="pickup">Pickup</option>
                </select>
            </div>
            <div>
                <label for="peso" data-text-id="522">Peso (t):</label>
                <input type="number" name="peso" id="peso" min="1" required>
            </div>
        </div>
        <input type="submit" value="Crear">
    </form>
    <div>
        <div id="mostrar-solo-boton">
            <div>
                <p data-text-id="480">Mostrar solo...</p>
                <img id="caret-mostrar-solo" src="/img/caret-abajo.png" alt="">
            </div>
            <button>
                <a href="/transporteCamiones" data-text-id="481">Camiones</a>
            </button>
            <button>
                <a href="/transportePickups">Pickups</a>
            </button>
        </div>
        <fieldset id="vehiculos-fieldset">
            <legend data-text-id="479">Vehículos</legend>
            <p class="texto-vehiculos" data-text-id="481">Camiones</p>
            <div class="vehiculos-container">
                @foreach($camiones as $camion)
                    @if($camion == $id)
                        <form action="/transporte/{{$camion}} style='background-color:#000'">
                            @csrf
                            <input type="submit" style="background-color:#478088" value="{{ $camion }}">
                        </form>
                    @else
                        <form action="/transporte/{{$camion}}">
                            @csrf
                            <input type="submit" value="{{ $camion }}">
                        </form>
                    @endif
                @endforeach
            </div>
            <p class="texto-vehiculos">Pickups</p>
            <div class="vehiculos-container">  
                @foreach($pickups as $pickup)
                    @if($pickup == $id)
                        <form action="/transporte/{{$pickup}}">
                            @csrf
                            <input type="submit" style="background-color:#478088" value="{{ $pickup }}">
                        </form>
                    @else
                        <form action="/transporte/{{$pickup}}">
                            @csrf
                            <input type="submit" value="{{ $pickup }}">
                        </form>
                    @endif
            @endforeach
            </div>
        </fieldset>
    </div>
    <fieldset id="info-fieldset">
        <legend data-text-id="484">Información del vehículo</legend>
        <ul>
            <div>
                <li><span data-text-id="485">Tipo</span>: {{ $tipo }}</li>
                <li><span data-text-id="487">Capacidad (t)</span>:  {{ $capacidad }}</li>
            </div>
            <li><span data-text-id="486">Conductor asignado</span>: {{ $conductor }}</li>
        </ul>
        <p class="bolder" data-text-id="488">Lotes/Paquetes asignados</p>
        <div id="paquetes-o-lotes-container">
            @foreach($paquetesOLotesAsignados as $item)
                <p>{{ $item }}</p>
            @endforeach
        </div>
        <form action="/transporte/{{ $id }}" method="POST">
            @method("DELETE")
            @csrf
            <button type="submit">
                <img src="/img/eliminar.png" alt="">
                <p data-text-id="523">Eliminar vehículo</p>
            </button>
        </form>
    </fieldset>
    <form action="" id="mas-opciones-form" style="display:none"></form>
</main>
<x-footer/>