<x-header/>
<link rel="stylesheet" href="/styles/paquetes.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-boton-volver link="/paqueteria"/>
<main>
    <div id="alerta" style="display:none;"></div>
    <fieldset id="container-paquetes">
        <legend data-text-id="428">Paquetes</legend>
        @foreach($paquetes as $paquete)
            <button type="button" data-id="{{ $paquete['id'] }}" class="boton-paquete">{{ $paquete['id'] }}</button>
        @endforeach 
    </fieldset>
    <fieldset id="informacion">
        <legend data-text-id="510">Informacion del paquete</legend>
        <div id="texto">
        <p data-text-id="420">Peso(kg):</p>
        <p data-text-id="425">Destino:</p>
        <p>Email:</p>
        <p><span data-text-id="477">Fecha de creación</span>:</p>
        <p data-text-id="421">Vehiculo asignado:</p>
        <p><span data-text-id="431">Lote asignado</span>:</p>
        </div>
        <div id="botones">
            <button type="button" id="eliminar" data-text-id="475">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
            </svg>
                Eliminar paquete
            </button>
        </div>
    </fieldset>
</main>
<script src="/js/paquetes.js"></script>
<x-footer/>