document.getElementById('boton-crear').addEventListener('click', () => {  
    activarEscalaDeGrises()
    const form= document.getElementById('creacion-popup')
    form.classList.toggle('mostrar')
})

document.getElementById('cerrar-creacion').addEventListener('click', () => {
    desactivarEscalaDeGrises()
    const form= document.getElementById('creacion-popup')
    form.classList.toggle('mostrar')
})

function activarEscalaDeGrises(){
    document.body.style.backdropFilter = "grayscale(1)"
    document.getElementById('boton-crear').style.filter = "grayscale(1)"
    document.getElementById('volver').style.filter = "grayscale(1)"
    document.querySelector('fieldset').style.filter = "grayscale(1)"
    document.querySelector('header').style.filter = "grayscale(1)"
    document.querySelector('footer').style.filter = "grayscale(1)"
    document.getElementById('boton-crear').style.pointerEvents ="none"
    document.getElementById('volver').style.pointerEvents = "none"
}

function desactivarEscalaDeGrises(){
    document.body.style.backdropFilter = "grayscale(0)"
    document.getElementById('boton-crear').style.filter = "grayscale(0)"
    document.getElementById('volver').style.filter = "grayscale(0)"
    document.querySelector('fieldset').style.filter = "grayscale(0)"
    document.querySelector('header').style.filter = "grayscale(0)"
    document.querySelector('footer').style.filter = "grayscale(0)"
    document.getElementById('boton-crear').style.pointerEvents ="all"
    document.getElementById('volver').style.pointerEvents = "all"
}