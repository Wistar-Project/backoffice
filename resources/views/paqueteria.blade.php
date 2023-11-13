@include('components/header')
<link rel="stylesheet" href="/styles/paqueteria.css">
<main>
<a href="lotes" class="container" id="lote-container">
            <h3 data-text-id="411">Lotes</h3>
            <img src="/img/LOTES SIN DETALLE.png" alt="Hubo un error al cargar la imagen.">
            <p class="texto-app" data-text-id="412">Administra los lotes de las almacenes.</p>
</a>
<a href="paquetes" class="container" id="paquete-container">
      <h3 data-text-id="413">Paquetes</h3>
      <img src="/img/paquetes.png" alt="Hubo un error al cargar la imagen.">
     <p class="texto-app" data-text-id="414">Administra los paquetes de las almacenes.</p>
</a>
</main>
@include('components/footer')