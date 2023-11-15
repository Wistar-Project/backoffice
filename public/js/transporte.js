document.getElementById('mostrar-solo-boton').addEventListener('click', () => {
    document.getElementById('mostrar-solo-boton').classList.toggle('abrir-menu-mostrar-solo')
    document.querySelectorAll('button').forEach(boton => {
        boton.classList.toggle('mostrar')
    })
    const caret = document.getElementById('caret-mostrar-solo')
    if(caret.src === "http://localhost:8004/img/caret-abajo.png")
        return caret.src = "/img/caret-arriba.png"
    caret.src = "/img/caret-abajo.png"
})

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