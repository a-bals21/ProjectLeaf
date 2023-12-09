function borrarUsuario(fuente) {
    let username = fuente.getAttribute('username');
    
    fetch("./../data/eliminar_usuario.php?username=" + username)
    .catch((err) => {console.error(err)})
    .finally(location.reload())
}