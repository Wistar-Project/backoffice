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
                const btnAsignar = document.getElementById('asignar-boton')
                const cerrar = document.getElementById('close-window')
                const containerAsignar = document.getElementById('container-asignar')
               info.innerHTML = `
                <ul>
                <li>Peso(kg): ${data.peso} </li>
                <li>Destino: ${data.destino} </li>
                <li>Fecha de modificacion: ${fecha} </li>
                </ul>
                ` 
                paquetes = data.paquetes
                paquetesContainer.innerHTML= `
                    <legend>Paquetes asignados</legend>
                    `
                paquetes.forEach(function(paquete){
                    const div = document.createElement('div')
                    div.setAttribute('id','paquete')
                    div.innerText = paquete
                    paquetesContainer.appendChild(div)
                })
                var myHeaders = new Headers();
                myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                btnAsignar.style.display='flex'
                btnAsignar.addEventListener('click',function(){
                    containerAsignar.classList.toggle('ver-asignar')
                })
                cerrar.addEventListener('click',function(){
                    containerAsignar.classList.toggle('ver-asignar')
                })
                btnEliminar.style.display = 'flex'
                btnEliminar.addEventListener('click',function(){
                    fetch('/paqueteria/lotes/' + userId,{
                        method:'DELETE',
                        headers:myHeaders,
                    })
                    .then(function(response){
                         setTimeout(function(){
                            window.location.reload()
                         },1000)   
                         const divAlerta = document.createElement('div')
                         divAlerta.className = 'alerta'
                         divAlerta.textContent = "Lote eliminado con exito"
                         document.body.appendChild(divAlerta)
                         divAlerta.style.display =  "flex"
                         setTimeout(function(){
                             divAlerta.style.display = "none"
                             document.body.removeChild(divAlerta)
                         }, 2000)
                    })
                    .catch(err =>{
                        const divAlerta = document.createElement('div')
                        divAlerta.className = 'alerta-error'
                        divAlerta.textContent = "Fallo al eliminar el lote"
                        document.body.appendChild(divAlerta)
                        divAlerta.style.display =  "flex"
                        setTimeout(function(){
                            divAlerta.style.display = "none"
                            document.body.removeChild(divAlerta)
                        }, 3500)
                        console.log(err)
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
