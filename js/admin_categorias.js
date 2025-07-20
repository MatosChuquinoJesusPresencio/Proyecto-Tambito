document.addEventListener('DOMContentLoaded', () => {
  // --- Gestión de Productos ---

  const guardarProductoBtn = document.querySelector('#guardar-producto');
  const limpiarFormularioBtn = document.querySelector('#limpiar-formulario');
  const guardarCambiosProductoBtn = document.querySelector('#guardar-cambios-producto');
  const eliminarProductoBtn = document.querySelector('#eliminar-producto'); 

  guardarProductoBtn.addEventListener('click', () => {
    const categoria = document.querySelector('#producto-categoria').value.trim();
    const codigo = document.querySelector('#codigo').value.trim();
    const nombre = document.querySelector('#nombre').value.trim();
    const precio = document.querySelector('#precio').value.trim();
    const imagen = document.querySelector('#imagen').files[0];

    if (!categoria || !codigo || !nombre || !precio || !imagen) {
      alert('Por favor completa todos los campos para crear un producto.');
      return;
    }

    const formData = new FormData();
    formData.append('categoria', categoria);
    formData.append('codigo', codigo);
    formData.append('nombre', nombre);
    formData.append('precio', precio);
    formData.append('imagen', imagen);

    fetch('routes/router.php?accion=guardar_producto', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Producto creado exitosamente.');
          location.reload();
        } else {
          alert('Error al crear producto: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al conectar con el servidor al intentar crear el producto.');
      });
  });

  // Listener de eventos para limpiar el formulario de producto
  limpiarFormularioBtn.addEventListener('click', () => {
    document.querySelector('#producto-categoria').value = '';
    document.querySelector('#codigo').value = '';
    document.querySelector('#nombre').value = '';
    document.querySelector('#precio').value = '';
    document.querySelector('#imagen').value = '';
  });

  // Listener de eventos para actualizar un producto existente
  if (guardarCambiosProductoBtn) {
    guardarCambiosProductoBtn.addEventListener('click', () => {
      const codigo = document.querySelector('#buscar-codigo').value.trim();
      const nombre = document.querySelector('#modificar-nombre').value.trim();
      const precio = document.querySelector('#modificar-precio').value.trim();
      const imagen = document.querySelector('#modificar-imagen').files[0];

      if (!codigo || !nombre || !precio) {
        alert('Completa los campos de código, nombre y precio para modificar el producto.');
        return;
      }

      const formData = new FormData();
      formData.append('codigo', codigo);
      formData.append('nombre', nombre);
      formData.append('precio', precio);
      if (imagen) {
        formData.append('imagen', imagen);
      }

      fetch('routes/router.php?accion=actualizar_producto', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Producto modificado con éxito.');
            document.dispatchEvent(new CustomEvent('productosActualizados'));
          } else {
            alert('Error al modificar producto: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Ocurrió un error al conectar con el servidor al intentar modificar el producto.');
        });
    });
  }

  // Listener de eventos para eliminar un producto
  if (eliminarProductoBtn) {
    eliminarProductoBtn.addEventListener('click', () => {
      const codigo = document.querySelector('#buscar-codigo').value.trim();

      if (!codigo) {
        alert('Por favor, ingresa el código del producto a eliminar en el campo "Código de Producto".');
        return;
      }

      if (!confirm(`¿Estás seguro de que quieres eliminar el producto con código: ${codigo}? Esta acción no se puede deshacer.`)) {
        return; 
      }

      const formData = new FormData();
      formData.append('codigo', codigo);

      fetch('routes/router.php?accion=eliminar_producto', { 
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Producto eliminado exitosamente.');
            location.reload();
          } else {
            alert('Error al eliminar producto: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Ocurrió un error al conectar con el servidor al intentar eliminar el producto.');
        });
    });
  }

  // --- Gestión de Categorías ---

  const modificarCategoriaBtn = document.querySelector('#modificar-categoria');
  const nombreAntiguoInput = document.getElementById('nombre-antiguo');
  const nombreNuevoInput = document.getElementById('nombre-nuevo');

  if (modificarCategoriaBtn) {
    modificarCategoriaBtn.addEventListener('click', () => {
      const categoriaAntigua = nombreAntiguoInput.value.trim();
      const categoriaNueva = nombreNuevoInput.value.trim();

      if (!categoriaAntigua || categoriaAntigua === 'Seleccionar una categoría' || !categoriaNueva) {
        alert('Selecciona una categoría antigua y escribe el nuevo nombre.');
        return;
      }

      const formData = new FormData();
      formData.append('categoria_antigua', categoriaAntigua);
      formData.append('categoria_nueva', categoriaNueva);

      fetch('routes/router.php?accion=modificar_categoria', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Categoría renombrada con éxito.');
            nombreAntiguoInput.value = '';
            nombreNuevoInput.value = '';
            location.reload();
          } else {
            alert('Error al renombrar categoría: ' + data.message);
          }
        })
        .catch(() => alert('Error al conectar con el servidor al intentar renombrar la categoría.'));
    });
  }
});