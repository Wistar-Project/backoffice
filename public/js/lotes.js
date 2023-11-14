document.querySelectorAll('.boton-lotes').forEach(function(button) {
    button.addEventListener('click', function() {
       var userId = this.getAttribute('data-id');
    
        
        fetch('/paqueteria/lotes/' + userId)
            .then(function(response) { return response.json(); })
            .then(function(data) {
                const info = document.getElementById('texto')
                const paquetesContainer = document.getElementById('paquetes')
                const fecha= formatearFecha(data.fechaDeModificacion)
                const btnEliminar = document.getElementById('eliminar-boton')
               info.innerHTML = `
                <ul>
                <li>Peso(kg): ${data.peso} </li>
                <li>Destino: ${data.destino} </li>
                <li>Fecha de modificacion: ${fecha} </li>
                </ul>
                ` 
                paquetes = data.paquetes
                paquetesContainer.innerHTML=''
                paquetes.forEach(function(paquete){
                    const div = document.createElement('div')
                    div.setAttribute('id','paquete')
                    paquetesContainer.innerHTML= `
                    <legend>Paquetes asignados</legend>
                    `
                    div.innerText = paquete
                    paquetesContainer.appendChild(div)
                })
                var myHeaders = new Headers();
                myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                btnEliminar.style.display = 'flex'
                btnEliminar.addEventListener('click',function(){
                    fetch('/paqueteria/lotes/' + userId,{
                        method:'DELETE',
                        headers:myHeaders,
                    })
                    .then(function(response){
                        if(response.ok){
                            window.location.reload(true)
                        }
                    })
                })
                
            }); 
    });
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
