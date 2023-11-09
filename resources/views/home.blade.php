@include('components/header')
<h3 id="aplicaciones-titulo" data-text-id="400">Administración</h3>
<main>
    <a class="container" id="usuarios-container" href="">
        <h3 data-text-id="401">Usuarios</h3>
        <img src="img/usuarios.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="402">Registra nuevos usuarios en el sistema, listalos y elimina o edita otros.</p>
    </a>
    <a class="container" id="transporte-container" href="">
        <h3 data-text-id="403">Transporte</h3>
        <img src="img/camion 2.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="404">Define los vehículos que posees y asigna choferes a cargo de ellos.</p>
    </a>
    <a href="">
        <div class="container" id="paqueteria-container" href="">
            <h3 data-text-id="405">Paquetería</h3>
            <img src="img/caja-del-paquete.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="406">Lista paquetes o lotes, edita los que necesites o elimina los que desees.</p>
        </div>
    </a>
    <a class="container" id="sedes-container" href="/sedes">
        <h3 data-text-id="407">Sedes</h3>
        <img src="img/administración_blanco 1.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="408">Define todas las sedes de la empresa para poder asignar camiones hacia esa dirección.</p>
    </a>
</main>
@include('components/footer')