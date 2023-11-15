document.querySelectorAll('.boton-paquete').forEach(function(button) {
    button.addEventListener('click', function() {
       var userId = this.getAttribute('data-id');
    
        
        fetch('/paqueteria/paquetes/' + userId)
            .then(function(response) { return response.json(); })
            .then(function(data) {
                const info = document.getElementById('informacion')
                const fecha= formatearFecha(data.fechaDeCreacion)
               info.innerHTML = `
                <legend> Informacion del paquete</legend>
                <p>Peso(kg):${data.peso}</p>
                <p>Destino:${data.destino}</p>
                <p>Fecha de creacion:${fecha}</p>
                <p>Vehiulo asignado:${data.vehiculoAsignado}</p>
                <p>Lote asignado:${data.loteAsignado}</p>
                ` 
            })
        })      
});
 function formatearFecha(fecha){
    const date = new Date(fecha)
    const options = {
        year: "numeric",
        month: "numeric",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        hour12: false,
      }
    return new Intl.DateTimeFormat("en-US", options).format(date).toString()
}
