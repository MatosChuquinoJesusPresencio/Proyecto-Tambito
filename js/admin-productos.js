const guardarBtn = document.querySelector('#guardar-producto');
const limpiarBtn = document.querySelector('#limpiar-formulario');

guardarBtn.addEventListener('click', () => {
const categoria = document.querySelector('#producto-categoria').value.trim();
  const codigo = document.querySelector('#codigo').value.trim();
  const nombre = document.querySelector('#nombre').value.trim();
  const precio = document.querySelector('#precio').value.trim();
  const imagen = document.querySelector('#imagen').files[0];

  if (!categoria || !codigo || !nombre || !precio || !imagen) {
    alert('Por favor completa todos los campos.');
    return;
  }

  const formData = new FormData();
  formData.append('categoria', categoria);
  formData.append('codigo', codigo);
  formData.append('nombre', nombre);
  formData.append('precio', precio); 
  formData.append('imagen', imagen);

  fetch('api/guardar_producto.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Producto creado exitosamente.');
        location.reload();
      } else {
        alert('Error: ' + data.message);
      }
    });
});

limpiarBtn.addEventListener('click', () => {
  document.querySelector('#categoria').value = '';
  document.querySelector('#codigo').value = '';
  document.querySelector('#nombre').value = '';
  document.querySelector('#precio').value = '';
  document.querySelector('#imagen').value = '';
});

document.querySelector('#guardar-cambios-producto').addEventListener('click', () => {
  const codigo = document.querySelector('#buscar-codigo').value.trim();
  const nuevoNombre = document.querySelector('#mod-nombre').value.trim();
  const nuevoPrecio = document.querySelector('#mod-precio').value.trim();
  const nuevaImagen = document.querySelector('#mod-imagen').files[0];

  if (!codigo || !nuevoNombre || !nuevoPrecio) {
    alert('Completa todos los campos necesarios.');
    return;
  }

  const formData = new FormData();
  formData.append('codigo', codigo);
  formData.append('nombre', nuevoNombre);
  formData.append('precio', nuevoPrecio);
  if (nuevaImagen) formData.append('imagen', nuevaImagen);

  fetch('api/modificar_producto.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert('Producto modificado correctamente');
    } else {
      alert('Error: ' + data.message);
    }
  });
});
  