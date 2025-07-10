document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('#modificar-categoria').addEventListener('click', () => {
    const antigua = document.querySelector('#nombre-antiguo').value.trim();
    const nueva = document.querySelector('#nombre-nuevo').value.trim();

    if (nueva === '' || antigua === 'Seleccionar una categoría') {
      alert('Selecciona una categoría y escribe el nuevo nombre');
      return;
    }

    const formData = new FormData();
    formData.append('categoria_antigua', antigua);
    formData.append('categoria_nueva', nueva);

    fetch('api/guardar_categorias.php', {
      method: 'POST',
      body: formData
    }) 
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Categoría modificada exitosamente');
          location.reload();
        } else {
          alert('Error: ' + data.message);
        }
      });
  });
});
