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
<fieldset id="container-crear">
    <legend>Crear usuario</legend>
    <svg id="close-window" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>

    <form action="/usuarios">
        <label for="">Nombre:</label><input type="text" name="nombre" placeholder="Nombre" required>
        <label for="">Apellido</label><input type="text"name="apellido"placeholder="Apellido"required>
        <label for="">Email:</label><input type="email" placeholder="email@email" name="email" required>
        <label for="">Rol:</label>
        <select name="rol">
                <option value="administrador">Administrador</option>
                <option value="funcionario">Funcionario</option>
                <option value="conductor">Conductor</option>
        </select>
        <label for="">Contraseña</label><input type="password" name="password" placeholder="contraseña" required>
        <label for="">Confirmar</label><input type="password" placeholder="repita la contraseña" name="password_confirmation" required>
        <input type="submit" value="Crear" id="crear-persona-boton">
    </form>
</fieldset>
</main>
<script src="/js/usuarios.js"></script>
<x-footer/>