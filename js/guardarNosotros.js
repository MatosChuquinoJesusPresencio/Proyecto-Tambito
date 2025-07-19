document.addEventListener('DOMContentLoaded', () => {
  const botonGuardar = document.getElementById('guardar-todo');
  if (!botonGuardar) return;

  botonGuardar.addEventListener('click', async (e) => {
    e.preventDefault();

    const secciones = ['nosotros', 'mision', 'vision'];
    let éxitoTotal = true;

    for (const seccion of secciones) {
      const exito = await guardarSeccion(seccion);
      if (!exito) éxitoTotal = false;
    }

    if (éxitoTotal) {
      alert('Actualización correcta.');
    } else {
      alert('Error al actualizar.');
    }
  });
});

async function guardarSeccion(seccion) {
  const formData = new FormData();

  const tituloInput = document.getElementById(`${seccion}-titulo`);
  const contenidoInput = document.getElementById(`${seccion}-descripcion`);
  const imagenInput = document.getElementById(`${seccion}-imagen`);

  const titulo = tituloInput?.value.trim() || '';
  const contenido = contenidoInput?.value.trim() || '';
  const imagen = imagenInput?.files?.[0];

  formData.append('seccion', seccion);
  formData.append('titulo', titulo);
  formData.append('contenido', contenido);
  if (imagen) {
    formData.append('imagen', imagen);
  }

  try {
    const respuesta = await fetch('routes/router.php?accion=guardar_nosotros', {
      method: 'POST',
      body: formData
    });

    const resultado = await respuesta.json();
    console.log(`Sección "${seccion}" guardada:`, resultado);
    return resultado.estado === 'ok';

  } catch (error) {
    console.error(`Error al guardar "${seccion}":`, error);
    return false;
  }
}