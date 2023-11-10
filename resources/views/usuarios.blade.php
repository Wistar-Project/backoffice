<x-header/>
<link rel="stylesheet" href="/styles/usuarios.css">
<h2 class="titulo">Usuarios</h2>
<main>
    <x-boton-volver/>
    <button type="button" id="boton-crear">Crear</button>
<fieldset id="container-usuarios">
    @foreach ($personas as $persona)
    <div class="personas">
        <p> {{ $persona['nombre'] }} </p>
        <p> {{ $persona['apellido'] }} </p>
    </div> 
    @endforeach
</fieldset>
<fieldset id="container-inspector">

</fieldset>
</main>

<x-footer/>