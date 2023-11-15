const nav = document.querySelector('header')

window.addEventListener('scroll', function(){
    nav.classList.toggle('activar', this.window.scrollY > 0)
})

const banderaSiguiente = document.getElementById('bandera-siguiente')
const banderaActual = document.getElementById('bandera-actual')

banderaSiguiente.addEventListener('click', () => {
    const TIEMPO_MUY_LARGO = 1000
    setCookie("language", siguienteIdioma(), TIEMPO_MUY_LARGO)
    actualizarParrafos()
    intercambiarAtributos()
})

function siguienteIdioma(){
    const idiomaActual = getCookie('language') ?? "es"
    return idiomaActual === "es" ? "en" : "es"
}

function intercambiarAtributos(){
    const ATRIBUTOS_A_INTERCAMBIAR = ["src", "alt"]
    ATRIBUTOS_A_INTERCAMBIAR.forEach(atributo => {
        intercambiarAtributo(atributo)
    })
}

function intercambiarAtributo(atributo){
    const temp = banderaActual[atributo]
    banderaActual[atributo] = banderaSiguiente[atributo]
    banderaSiguiente[atributo] = temp
}

if(getCookie('language') === "en") 
    intercambiarAtributos()

function daysToMiliseconds(days){
    const MILISECONDS_IN_A_SECOND = 1000
    const SECONDS_IN_A_MINUTE = 60
    const MINUTES_IN_AN_HOUR = 60
    const HOURS_IN_A_DAY = 24
    return days * HOURS_IN_A_DAY * MINUTES_IN_AN_HOUR * SECONDS_IN_A_MINUTE * MILISECONDS_IN_A_SECOND
}

function setCookie(name, value, expirationDays) {
    const date = new Date()
    date.setTime(date.getTime() + daysToMiliseconds(expirationDays))
    const expires = `expires=${date.toUTCString()}`
    document.cookie = `${name} = ${value}; ${expires}; path=/`
}

 function getCookie(cname) {
    let name = cname + "="
    let decodedCookie = decodeURIComponent(document.cookie)
    let ca = decodedCookie.split(';')
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i]
        while (c.charAt(0) == ' ') {
        c = c.substring(1)
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length)
        }
    }
    return ""
}

 function deleteCookie(name){
    setCookie(name, "", "Thu, 01 Jan 1970 00:00:00 UTC")
}

window.deleteCookie = deleteCookie


 async function actualizarParrafos(){
    const parrafos = document.querySelectorAll('[data-text-id]')
    const traducciones = await obtenerTraducciones()
    parrafos.forEach(parrafo => {
        const texto = obtenerTextoTraducido({
            traducciones,
            id: parrafo.getAttribute('data-text-id'),
            idioma: getCookie('language') || 'es'
        })
        parrafo.innerHTML = texto
    })
}

actualizarParrafos()

async function obtenerTraducciones(){
    const traduccionesEnCache = getCookie('translations')
    if(!traduccionesEnCache){
        const traduccionesParseadas = await pedirTraducciones()
        setCookie('translations', JSON.stringify(traduccionesParseadas), 15)
        return traduccionesParseadas
    }
    return JSON.parse(traduccionesEnCache)
}

async function pedirTraducciones(){ 
    const response = await fetch(`http://localhost:8002/api/v1/traduccion`)
    return await response.json()
}

function obtenerTextoTraducido({ traducciones, id, idioma }){
    const traduccion = traducciones.filter(
        traduccion => 
            traduccion.id == id && traduccion.idioma === idioma
    )
    return traduccion[0].texto
}

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