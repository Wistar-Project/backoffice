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
                <legend>Datos modificables </legend>
                <p> Nombre completo: ${data.nombre} ${data.apellido} </p>
                <p> Email : ${data.email} </p>
                <p> Rol : ${data.rol}</P>
                ` 
            });
            eliminar.style.display = 'flex'
            editar.style.display = 'flex'
            editar.addEventListener('click',function(){
                ventana.classList.toggle('ver')
            })
            cerrar.addEventListener('click',function(){
                ventana.classList.toggle('ver')
            })
    });
});

buscarBoton.addEventListener('click',function(){
formBuscar.classList.toggle('ver-buscar')
})
cerrarBuscar.addEventListener('click',function(){
    formBuscar.classList.toggle('ver-buscar')
})