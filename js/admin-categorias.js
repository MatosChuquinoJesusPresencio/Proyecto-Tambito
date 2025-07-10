document.addEventListener('DOMContentLoaded', () => {
    const antiguo = document.getElementById('nombre-antiguo');
    const nuevo = document.getElementById('nombre-nuevo');
    const boton = document.getElementById('modificar-categoria');

    boton.addEventListener('click', () => {
        const categoria_antigua = antiguo.value.trim();
        const categoria_nueva = nuevo.value.trim();

        if (!categoria_antigua || !categoria_nueva) {
            alert('Completa ambos campos.');
            return;
        }

        const formData = new FormData();
        formData.append('categoria_antigua', categoria_antigua);
        formData.append('categoria_nueva', categoria_nueva);

        fetch('api/guardar_categorias.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('Categoría renombrada con éxito');
                antiguo.value = '';
                nuevo.value = '';
            } else {
                alert('Error: ' + res.message);
            }
        })
        .catch(() => alert('Error al conectar con el servidor'));
    });
}); 
