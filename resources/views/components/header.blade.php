<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gotruck</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estructura.css">
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