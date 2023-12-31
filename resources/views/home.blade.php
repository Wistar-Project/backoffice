@include('components/header')
<h3 id="aplicaciones-titulo" data-text-id="407">Administración</h3>
<main>
    <a class="container" id="usuarios-container" href="/usuarios">
        <h3 data-text-id="463">Usuarios</h3>
        <img src="img/usuarios.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="464">Registra nuevos usuarios en el sistema, listalos y elimina o edita otros.</p>
    </a>
    <a class="container" id="transporte-container" href="/transporte">
        <h3 data-text-id="465">Transporte</h3>
        <img src="img/camion 2.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="466">Define los vehículos que posees y asigna choferes a cargo de ellos.</p>
    </a>
    <a class="container" id="paqueteria-container" href="/paqueteria">
        <h3 data-text-id="467">Paquetería</h3>
        <img src="img/caja-del-paquete.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="468">Lista paquetes o lotes, edita los que necesites o elimina los que desees.</p>
    </a>
    <a class="container" id="sedes-container" href="/sedes">
        <h3 data-text-id="469">Sedes</h3>
        <img src="img/administración_blanco 1.png" alt="Hubo un error al cargar la imagen.">
        <p class="texto-app" data-text-id="470">Define todas las sedes de la empresa para poder asignar camiones hacia esa dirección.</p>
    </a>
</main>
@include('components/footer')