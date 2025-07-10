document.addEventListener('DOMContentLoaded', function () {
    const saveEsloganButton = document.getElementById('guardar-eslogan');
    const saveCategoriasButton = document.getElementById('guardar-categorias-home');

    // Función para cargar los datos de inicio actuales en el formulario
    function loadInicioData() {
        fetch('api/inicio.php')
            .then(res => res.json())
            .then(data => {
                if (data) {
                    // Cargar eslogan
                    document.getElementById('admin-eslogan').value = data.eslogan || '';

                    // Cargar categorías
                    const categoriasDestacadas = data.categorias_destacadas;
                    for (let i = 0; i < 5; i++) {
                        const categoria = categoriasDestacadas[i];
                        if (categoria) {
                            document.getElementById(`admin-categoria-${i + 1}-nombre`).value = categoria.nombre || '';
                            // Guardar la URL actual de la imagen en un campo oculto para que no se pierda si no se sube una nueva
                            const hiddenInput = document.getElementById(`admin-categoria-${i + 1}-imagen-actual`);
                            if (hiddenInput) {
                                hiddenInput.value = categoria.imagen_url || '';
                            }
                        } else {
                            // Limpiar campos si no hay datos para esta categoría
                            document.getElementById(`admin-categoria-${i + 1}-nombre`).value = '';
                            const hiddenInput = document.getElementById(`admin-categoria-${i + 1}-imagen-actual`);
                            if (hiddenInput) {
                                hiddenInput.value = '';
                            }
                        }
                    }
                }
            })
            .catch(err => {
                console.error('Error al cargar datos de inicio:', err);
            });
    }

    // Cargar datos cuando la página del administrador se carga
    loadInicioData();

    // Event listener para guardar eslogan
    if (saveEsloganButton) {
        saveEsloganButton.addEventListener('click', function (e) {
            e.preventDefault();
            const eslogan = document.getElementById('admin-eslogan').value;

            // Recopilar los datos de categorías existentes para no perderlos al guardar solo el eslogan
            const formData = new FormData();
            formData.append('eslogan', eslogan);

            // Obtener las categorías actuales para enviarlas también
            fetch('api/inicio.php')
                .then(res => res.json())
                .then(currentData => {
                    if (currentData && currentData.categorias_destacadas) {
                        currentData.categorias_destacadas.forEach((cat, index) => {
                            formData.append(`categoria_${index}_nombre`, cat.nombre);
                            formData.append(`categoria_${index}_imagen_actual`, cat.imagen_url);
                        });
                    }

                    sendInicioData(formData, 'eslogan');
                })
                .catch(err => {
                    console.error('Error al obtener datos actuales para guardar eslogan:', err);
                    alert('Error al guardar el eslogan. Inténtelo de nuevo.');
                });
        });
    }

    // Event listener para guardar categorías
    if (saveCategoriasButton) {
        saveCategoriasButton.addEventListener('click', function (e) {
            e.preventDefault();
            const formData = new FormData();
            
            // Obtener el eslogan actual para enviarlo también
            fetch('api/inicio.php')
                .then(res => res.json())
                .then(currentData => {
                    if (currentData && currentData.eslogan) {
                        formData.append('eslogan', currentData.eslogan);
                    } else {
                        formData.append('eslogan', ''); // Si no hay eslogan, envía vacío
                    }

                    // Recopilar los datos de las categorías del formulario
                    for (let i = 0; i < 5; i++) {
                        const nombreInput = document.getElementById(`admin-categoria-${i + 1}-nombre`);
                        const imagenInput = document.getElementById(`admin-categoria-${i + 1}-imagen`);
                        const imagenActualInput = document.getElementById(`admin-categoria-${i + 1}-imagen-actual`);

                        formData.append(`categoria_${i}_nombre`, nombreInput.value);
                        formData.append(`categoria_${i}_imagen_actual`, imagenActualInput.value); // URL de la imagen actual
                        if (imagenInput.files[0]) {
                            formData.append(`categoria_${i}_imagen`, imagenInput.files[0]); // Nueva imagen
                        }
                    }

                    sendInicioData(formData, 'categorias');
                })
                .catch(err => {
                    console.error('Error al obtener datos actuales para guardar categorías:', err);
                    alert('Error al guardar las categorías. Inténtelo de nuevo.');
                });
        });
    }

    // Función genérica para enviar los datos de inicio
    function sendInicioData(formData, sectionName) {
        fetch('api/guardar_inicio.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert(`Contenido de ${sectionName} guardado correctamente.`);
                loadInicioData(); // Recargar datos para reflejar los cambios
            } else {
                alert(`Error al guardar ${sectionName}: ` + (res.message || 'Desconocido'));
            }
        })
        .catch(err => {
            console.error(`Error en la petición para guardar ${sectionName}:`, err);
            alert(`Error en la petición para guardar ${sectionName}.`);
        });
    }

    // Manejar botones de limpiar si es necesario (el HTML no los tiene actualmente para Eslogan/Categorías del Home)
    // Si decides añadir un botón "Limpiar Eslogan" o "Limpiar Categorías", puedes añadir aquí su lógica.
    // Por ejemplo:
    // const limpiarEsloganButton = document.getElementById('limpiar-eslogan');
    // if (limpiarEsloganButton) {
    //     limpiarEsloganButton.addEventListener('click', function() {
    //         document.getElementById('admin-eslogan').value = '';
    //     });
    // }
});