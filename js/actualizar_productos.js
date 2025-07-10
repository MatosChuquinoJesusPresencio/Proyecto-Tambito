document.addEventListener('DOMContentLoaded', () => {
  const guardarBtn = document.querySelector('#guardar-cambios-producto');

  guardarBtn.addEventListener('click', () => {
    const codigo = document.querySelector('#buscar-codigo').value.trim();
    const nombre = document.querySelector('#modificar-nombre').value.trim();
    const precio = document.querySelector('#modificar-precio').value.trim();
    const imagen = document.querySelector('#modificar-imagen').files[0];

    if (!codigo || !nombre || !precio) {
      alert('Completa todos los campos obligatorios.');
      return;
    }
 
    const formData = new FormData();
    formData.append('codigo', codigo);
    formData.append('nombre', nombre);
    formData.append('precio', precio);
    if (imagen) {
      formData.append('imagen', imagen);
    }

    fetch('api/actualizar_producto.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Producto modificado con éxito.');
          document.dispatchEvent(new CustomEvent('productosActualizados'));
        } else {
          alert('Error: ' + data.message);
        }
      });
  });
});
