function validarRegistro() {
    const pass1 = document.getElementById('password').value;
    const pass2 = document.getElementById('confirm-password').value;

    if (pass1 !== pass2) {
        alert('Las contraseñas no coinciden.');
        return false;
    }
    return true;
}
