function validarLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    if (email === '' || password === '') {
        alert('Por favor, complete todos los campos.');
        return false;
    }

    // Puedes agregar más validaciones (como formato de email)
    return true;
}
