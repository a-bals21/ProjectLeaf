function sumarACarrito(fuente) {
    let id = fuente.getAttribute("producto-id");

    fetch('../carrito/agregador.php/?id=' + id)
        .then(
            response => {
                if (response.ok) {
                    return response.json
                }
            })
        .then(
            response => console.log(response)
        )
        .catch(
            err => console.error('Error: ' + err.message)
        )
        .finally(
            () => {
                let notificaciones = document.querySelector("#notificaciones")

                if (notificaciones != null) {
                    let notificacionAnterior = notificaciones.querySelector(".notificacion")

                    if (notificacionAnterior != null) {
                        notificacionAnterior.remove()
                    }

                    let notificacion = document.createElement("div")
                    notificacion.className = "notificacion"
                    notificacion.addEventListener('animationend', () => {
                        notificacion.remove()
                    })
                    notificaciones.append(notificacion)

                    let text = document.createTextNode("Se ha agregado!")
                    notificacion.appendChild(text)

                    notificaciones.scrollTop = notificaciones.scrollHeight - notificaciones.clientHeight;
                }
            }
        )
}

function restarDeCarrito(fuente) {
    let id = fuente.getAttribute("producto-id");

    fetch('../carrito/quitador.php/?id=' + id)
        .then(
            response => {
                if (response.ok) {
                    return response.json
                }
            })
        .then(
            response => console.log(response)
        )
        .catch(
            err => console.error('Error: ' + err.message)
        )
        .finally(
            () => window.location.reload()
        )
}

function eliminarDeCarrito(fuente) {
    let id = fuente.getAttribute("producto-id");

    fetch('../carrito/eliminador.php/?id=' + id)
        .then(
            response => {
                if (response.ok) {
                    return response.json
                }
            })
        .then(
            response => console.log(response)
        )
        .catch(
            err => console.error('Error: ' + err.message)
        )
        .finally(
            () => window.location.reload()
        )
}
