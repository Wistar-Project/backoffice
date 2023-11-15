
document.getElementById('boton-crear').addEventListener('click', () => {
    activarEscalaDeGrises()
    const form = document.getElementById('creacion-popup')
    form.classList.toggle('mostrar')
})

document.getElementById('cerrar-creacion').addEventListener('click', () => {
    desactivarEscalaDeGrises()
    const form = document.getElementById('creacion-popup')
    form.classList.toggle('mostrar')
})

function activarEscalaDeGrises() {
    document.body.style.backdropFilter = "grayscale(1)"
    document.getElementById('boton-crear').style.filter = "grayscale(1)"
    document.getElementById('volver').style.filter = "grayscale(1)"
    document.querySelector('fieldset').style.filter = "grayscale(1)"
    document.querySelector('header').style.filter = "grayscale(1)"
    document.querySelector('footer').style.filter = "grayscale(1)"
    document.getElementById('info-fieldset').style.filter = "grayscale(1)"
    document.getElementById('mostrar-solo-boton').style.filter = "grayscale(1)"
    document.getElementById('boton-crear').style.pointerEvents = "none"
    document.getElementById('volver').style.pointerEvents = "none"
}

function desactivarEscalaDeGrises() {
    document.body.style.backdropFilter = "grayscale(0)"
    document.getElementById('boton-crear').style.filter = "grayscale(0)"
    document.getElementById('volver').style.filter = "grayscale(0)"
    document.querySelector('fieldset').style.filter = "grayscale(0)"
    document.querySelector('header').style.filter = "grayscale(0)"
    document.querySelector('footer').style.filter = "grayscale(0)"
    document.getElementById('boton-crear').style.pointerEvents = "all"
    document.getElementById('volver').style.pointerEvents = "all"
    document.getElementById('info-fieldset').style.filter = "grayscale(0)"
    document.getElementById('mostrar-solo-boton').style.filter = "grayscale(0)"
}


function mostrarMasOpciones(id) {
    
    document.getElementById('mas-opciones-form').action = `/transporte/desasignar/${id}`
    document.getElementById('mas-opciones-form').innerHTML = `
        <div>
            <p class="bolder">Opciones</p>
            <img src="/img/cruz.png" alt="" id="cerrar-opciones-form"/>
        </div>
        <input type="submit" value="Desasignar del vehículo">
    `
    document.getElementById('mas-opciones-form').style.display = "flex"
    document.getElementById('cerrar-opciones-form').addEventListener('click', () => {
        document.getElementById('mas-opciones-form').style.display = "none"
        desactivarEscalaDeGrises()
    }) 
}

document.getElementById("paquetes-o-lotes-container").childNodes.forEach(item => {
    item.addEventListener('click', () => {
        activarEscalaDeGrises()
        mostrarMasOpciones(item.textContent)
    })
})