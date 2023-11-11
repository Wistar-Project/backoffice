<x-header/>
<link rel="stylesheet" href="/styles/usuarios.css">
<h2 class="titulo">Usuarios</h2>
<main>
    <x-boton-volver/>
    <button type="button" id="boton-crear">Crear</button>
<fieldset id="container-usuarios">
    <legend>Usuarios</legend>
    @foreach ($personas as $persona)
    <button type="button" class="personas" data-id="{{ $persona['id'] }}">
         {{ $persona['nombre'] }} 
         {{ $persona['apellido'] }} 
    </button> 
    @endforeach
</fieldset>
<fieldset id="container-inspector">
    <legend>Informacion del usuario</legend>
    <fieldset id="informacion">
        <legend>Datos modificables</legend>
    </fieldset>
    <button id="boton-eliminar">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>  
    Eliminar usuario
    </button>
</fieldset>
<fieldset id="container-crear">
    <legend>Crear usuario</legend>
    <svg id="close-window" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>

    <form action="/usuarios" method="post">
        @csrf
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