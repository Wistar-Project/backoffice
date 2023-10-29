<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gotruck</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
</head>
<body>
<header>
        <div class="logo">
            <img src="img/logo.png" alt="logo" class="logo-app">
            <h1>GoTruck</h1>
        </div>
        <div class="menu">
            <ul class="nav">
                <li>
                    <img src="img/espana.png" class="bandera" alt="Español" id="bandera-actual">
                    <img src="img/caret-abajo.png" class="flecha" alt="Abrir menú">
                    <ol>
                        <li>
                            <img src="img/reino-unido.png" class="bandera" alt="Inglés" id="bandera-siguiente">
                        </li>
                    </ol>
                </li>
            </ul>
            <img src="img/avatar.png" alt="login" class="avatar-login" id="account-avatar">
        </div>  
        <div id="opciones-usuario">
            <div id="boton-cerrar-sesion">
                <img src="img/cerrar-sesion.png" alt="Salir">
                <p data-text-id="100">Cerrar sesión</p>
            </div>
        </div>  
    </header>
    <h3 id="aplicaciones-titulo" data-text-id="400">Administración</h3>
    <main>
        <a class="container" id="usuarios-container" href="">
            <h3 data-text-id="401">Usuarios</h3>
            <img src="img/usuarios.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="402">Registra nuevos usuarios en el sistema, listalos y elimina o edita otros.</p>
        </a>
        <a class="container" id="transporte-container">
            <h3 data-text-id="403">Transporte</h3>
            <img src="img/camion 2.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="404">Define los vehículos que posees y asigna choferes a cargo de ellos.</p>
        </a>
        <a href="">
            <div class="container" id="paqueteria-container">
                <h3 data-text-id="405">Paquetería</h3>
                <img src="img/caja-del-paquete.png" alt="Hubo un error al cargar la imagen.">
                <p class="texto-app" data-text-id="406">Lista paquetes o lotes, edita los que necesites o elimina los que desees.</p>
            </div>
        </a>
        <div class="container" id="sedes-container">
            <h3 data-text-id="407">Sedes</h3>
            <img src="img/administración_blanco 1.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="408">Define todas las sedes de la empresa para poder asignar camiones hacia esa dirección..</p>
        </div>
    </main>
    <footer>
      
            <a href="#" data-text-id="200">Política y privacidad</a>
            <p id="copyright">© GoTruck 2023 - <span data-text-id="202">Todos los derechos reservados</span></p>
            <div id="logo-nombre">
                <h3 id="titulo-footer">GoTruck</h3>
                <img src="/img/logo.png" alt="logo" class="logo-app" id="logo-footer">
            </div>
        </div>
    </footer>
        <script src="main.js"></script>
</body>
</html>