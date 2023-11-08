@include('components/header')
<link rel="stylesheet" href="styles/sedes.css">
<h2 class="titulo">Sedes</h2>
<main>
    @include('components/boton-volver')
    <button type="button" id="boton-buscar">Crear</button>
    <fieldset>
        <legend>Sedes</legend>
        @foreach($sedes as $sede)
            <form class="sede-container" method="POST" action="/sedes/{{ $sede -> id }}">
                @csrf
                @method('DELETE')
                <button></button>
                <p>{{ $sede -> alojamiento -> direccion }}</p>
            </form>
        @endforeach
    </fieldset>
</main>
@include('components/footer')