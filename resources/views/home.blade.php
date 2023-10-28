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
                <img src="cerrar-sesion.png" alt="Salir">
                <p data-text-id="100">Cerrar sesión</p>
            </div>
        </div>  
    </header>
    <h3 id="aplicaciones-titulo" data-text-id="400">Administración</h3>
    <main>
        <a class="container" id="usuarios-container" href="">
            <h3 data-text-id="401">Usuarios</h3>
            <img src="img/usuarios.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="402">Ve el estado de una entrega buscándola por su id.</p>
        </a>
        <a class="container" id="transporte-container">
            <h3 data-text-id="403">Transporte</h3>
            <img src="img/camion 2.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="404">Visualiza las entregas pendientes y el trayecto hacia la sede más cercana.</p>
        </a>
        <a href="">
            <div class="container" id="paqueteria-container">
                <h3 data-text-id="405">Paquetería</h3>
                <img src="img/caja-del-paquete.png" alt="Hubo un error al cargar la imagen.">
                <p class="texto-app" data-text-id="406">Gestiona lotes con sus paquetes y asígnalos a un camión para ser entregados.</p>
            </div>
        </a>
        <div class="container" id="sedes-container">
            <h3 data-text-id="407">Sedes</h3>
            <img src="img/administración_blanco 1.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="408">Adéntrese en el mundo corporativo y gestione su equipo de trabajo.</p>
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
</body>
</html>