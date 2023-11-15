document.getElementById('mostrar-solo-boton').addEventListener('click', () => {
    document.getElementById('mostrar-solo-boton').classList.toggle('abrir-menu-mostrar-solo')
    document.querySelectorAll('button').forEach(boton => {
        boton.classList.toggle('mostrar')
    })
    const caret = document.getElementById('caret-mostrar-solo')
    if (caret.src === "http://localhost:8004/img/caret-abajo.png")
        return caret.src = "/img/caret-arriba.png"
    caret.src = "/img/caret-abajo.png"
})
