document.querySelectorAll('.boton-paquete').forEach(function(button) {
    button.addEventListener('click', function() {
       var userId = this.getAttribute('data-id');
       document.querySelectorAll('.boton-paquete.selected').forEach(function(button) {
        button.classList.remove('selected');
    });
    this.classList.add('selected');
    const eliminar = document.getElementById('eliminar')
        fetch('/paqueteria/paquetes/' + userId)
            .then(function(response) { return response.json(); })
            .then(function(data) {
                const info = document.getElementById('texto')
                const fecha= formatearFecha(data.fechaDeCreacion)
               info.innerHTML = `
                <p>Peso(kg): ${data.peso}</p>
                <p>Destino: ${data.destino}</p>
                <p>Email: ${data.email}</p>
                <p>Fecha de creación: ${fecha}</p>
                <p>Vehiculo asignado: ${data.vehiculoAsignado}</p>
                <p>Lote asignado: ${data.loteAsignado}</p>
                ` 
              
                console.log(eliminar)
                var myHeaders = new Headers();
                myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                eliminar.style.display = 'flex'
                eliminar.addEventListener('click',function(){
                    fetch('/paqueteria/paquetes/' + userId,{
                        method:'DELETE',
                        headers:myHeaders,
                    })
                    .then(function(response){
                        if(response.ok){
                         setTimeout(function(){
                            window.location.reload()
                         },1000)   
                         const divAlerta = document.createElement('div')
                         divAlerta.className = 'alerta'
                         divAlerta.textContent = "Paquete eliminado con exito"
                         document.body.appendChild(divAlerta)
                         divAlerta.style.display =  "flex"
                         setTimeout(function(){
                             divAlerta.style.display = "none"
                             document.body.removeChild(divAlerta)
                         }, 2000)
                       
                        } 
                    })
                    .catch(err =>{
                        const divAlerta = document.createElement('div')
                        divAlerta.className = 'alerta-error'
                        divAlerta.textContent = "Fallo al eliminar el paquete"
                        document.body.appendChild(divAlerta)
                        divAlerta.style.display =  "flex"
                        setTimeout(function(){
                            divAlerta.style.display = "none"
                            document.body.removeChild(divAlerta)
                        }, 3500)
                        console.log(err)
                    })
                })
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
