const botonCrear= document.getElementById('boton-crear')
const close = document.getElementById('close-window')
const form= document.getElementById('container-crear')
botonCrear.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})
close.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})

document.querySelectorAll('.personas').forEach(function(button) {
    button.addEventListener('click', function() {
       const eliminar = document.getElementById('boton-eliminar')
       eliminar.style.display = 'flex'
         document.querySelectorAll('.personas.selected').forEach(function(button) {
            button.classList.remove('selected');
        });
        this.classList.add('selected');
        var userId = this.getAttribute('data-id');
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
    });
});