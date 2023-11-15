<x-header/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/styles/usuarios.css">
<h2 class="titulo" data-text-id="463">Usuarios</h2>
<main>
<button type="button" id="buscar-boton" data-text-id="496">Buscar por</button>
<form action="/usuarios" method="GET" id="form">
    <input type="hidden" value="todos" name="todos">
    <button type="submit" id="mostrar-todos-activos" data-text-id="436">Mostrar todos</button>
</form>
    @isset($mensaje)
        <x-alerta :color="$mensaje['color']">{{$mensaje['texto']}} </x-alerta>
    @endisset
    <x-boton-volver link="/"/>
    <button type="button" id="boton-crear" data-text-id="416">Crear</button>
<fieldset id="container-usuarios">
    <legend data-text-id="463">Usuarios</legend>
    @foreach ($personas as $persona)
    <button type="button" class="personas" data-id="{{ $persona['id'] }}">
         {{ $persona['nombre'] }} 
         {{ $persona['apellido'] }} 
    </button> 
    @endforeach
</fieldset>
<fieldset id="container-inspector">
    <legend data-text-id="499">Informacion del usuario</legend>
    <fieldset id="informacion">
        <legend data-text-id="500">Datos modificables</legend>
    </fieldset>
    <form action="/usuarios/{{ $persona['id'] }}"id="form-eliminar" method="post">
        @csrf
        @method('DELETE')
    <button type="submit" id="boton-eliminar" data-text-id="507">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>  
    Eliminar usuario
    </button>
    </form>
    <button type="button" id="editar-boton" data-text-id="512">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg>
    Editar usuario
    </button>
</fieldset>
<fieldset id="container-crear">
    <legend data-text-id="513">Crear usuario</legend>
    <svg id="close-window" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>

    <form action="/usuarios" method="post">
        @csrf
        <label for="" data-text-id="497">Nombre:</label><input type="text" name="nombre" placeholder="Nombre" required>
        <label for="" data-text-id="514">Apellido</label><input type="text"name="apellido"placeholder="Apellido"required>
        <label for="">Email:</label><input type="email" placeholder="email@email" name="email" required>
        <label for="" data-text-id="515">Rol:</label>
        <select name="rol">
                <option value="administrador" data-text-id="516">Administrador</option>
                <option value="funcionario" data-text-id="517">Funcionario</option>
                <option value="conductor" data-text-id="518">Conductor</option>
        </select>
        <label for="" data-text-id="303">Contraseña</label><input type="password" name="password" placeholder="contraseña" required>
        <label for="" data-text-id="519">Confirmar</label><input type="password" placeholder="repita la contraseña" name="password_confirmation" required>
        <input type="submit" value="Crear" id="crear-persona-boton">
    </form>
</fieldset>
    <fieldset id="container-editar">
    <legend data-text-id="512">Editar usuario</legend>
    <svg id="cerrar-ventana" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>
        <form action="/usuarios/{{ $persona['id'] }}" id="editar-form" method="POST">
                @csrf
                @method('PUT')
                <label for="" data-text-id="497">Nombre</label><input type="text" value="{{ old('nombre', $persona['nombre'])}}" name="nombre">
                <label for="" data-text-id="514">Apellido :</label> <input type="text"value="{{ old('apellido', $persona['apellido'])}}" name="apellido">
                <label for="">Email</label> <input type="email"value="{{ old('email', $persona['email'])}}"  name="email">
                <label for="" data-text-id="303">Contraseña :</label> <input type="password" name="contraseña" />
                <input type="submit" value="Guardar" id="guardar">
        </form>
    </fieldset>
    <fieldset id="container-buscar">
        <legend data-text-id="496">Buscar por</legend>
    <svg id="cerrar-buscar" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
</svg>
            <form action="">
                <label for="" data-text-id="497">Nombre :</label><input type="text" name="nombre">
                <label for="">Email :</label><input type="text" name="email">
                <button type="submit" id="buscar" data-text-id="452">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
               </svg>
              Buscar</button>
            </form>
    </fieldset>
</main>
<script src="/js/usuarios.js"></script>
<x-footer/>