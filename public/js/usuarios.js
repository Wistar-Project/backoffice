const botonCrear= document.getElementById('boton-crear')
const close = document.getElementById('close-window')
const form= document.getElementById('container-crear')
botonCrear.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})
close.addEventListener('click', function(){
    form.classList.toggle('mostrar')
})