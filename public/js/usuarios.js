const botonCrear= document.getElementById('boton-crear')
const close = document.getElementById('close-window')
const form= document.getElementById('container-crear')
const buscarBoton = document.getElementById('buscar-boton')
const cerrarBuscar = document.getElementById('cerrar-buscar')
const formBuscar = document.getElementById('container-buscar')
botonCrear.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})
close.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})

document.querySelectorAll('.personas').forEach(function(button) {
    button.addEventListener('click', function() {
       var userId = this.getAttribute('data-id');
       const editar = document.getElementById('editar-boton')
       const  cerrar = document.getElementById('cerrar-ventana')
       const ventana = document.getElementById('container-editar')
       const eliminar = document.getElementById('form-eliminar')
         document.querySelectorAll('.personas.selected').forEach(function(button) {
            button.classList.remove('selected');
        });
        this.classList.add('selected');
        
        fetch('/usuarios/' + userId)
            .then(function(response) { return response.json(); })
            .then(function(data) {
                const info = document.getElementById('informacion')
               info.innerHTML = `
               <ul>
                    <li>Nombre completo: ${data.nombre} ${data.apellido}</li>
                    <li>Email: ${data.email}</li>
                    <li>Rol: ${data.rol}</li>
               </ul>
                ` 
            });
            eliminar.style.display = 'flex'
            document.getElementById('form-eliminar').action = `/usuarios/${userId}`
            document.getElementById('editar-form').action = `/usuarios/${userId}`
            editar.style.display = 'flex'
            editar.addEventListener('click',function(){
                ventana.classList.add('ver')
            })
            cerrar.addEventListener('click',function(){
                ventana.classList.remove('ver')
            })
    });
});

buscarBoton.addEventListener('click',function(){
formBuscar.classList.toggle('ver-buscar')
})
cerrarBuscar.addEventListener('click',function(){
    formBuscar.classList.toggle('ver-buscar')
})