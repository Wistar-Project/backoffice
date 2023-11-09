document.getElementById('boton-crear').addEventListener('click', () => {  
    activarEscalaDeGrises()
    document.getElementById('creacion-popup').style.display = "flex"
})

document.getElementById('cerrar-creacion').addEventListener('click', () => {
    desactivarEscalaDeGrises()
    document.getElementById('creacion-popup').style.display = "none"
})

function activarEscalaDeGrises(){
    document.body.style.backdropFilter = "grayscale(1)"
    document.getElementById('boton-crear').style.filter = "grayscale(1)"
    document.getElementById('volver').style.filter = "grayscale(1)"
    document.querySelector('fieldset').style.filter = "grayscale(1)"
    document.querySelector('header').style.filter = "grayscale(1)"
    document.querySelector('footer').style.filter = "grayscale(1)"
}

function desactivarEscalaDeGrises(){
    document.body.style.backdropFilter = "grayscale(0)"
    document.getElementById('boton-crear').style.filter = "grayscale(0)"
    document.getElementById('volver').style.filter = "grayscale(0)"
    document.querySelector('fieldset').style.filter = "grayscale(0)"
    document.querySelector('header').style.filter = "grayscale(0)"
    document.querySelector('footer').style.filter = "grayscale(0)"
}