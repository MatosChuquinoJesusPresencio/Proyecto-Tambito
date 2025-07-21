document.addEventListener('DOMContentLoaded', function() {
            const carritoListaDiv = document.getElementById('carrito-productos-lista');
            const totalCarritoSpan = document.getElementById('total-carrito');
            const btnProcesarPago = document.getElementById('btn-procesar-pago');

            function cargarProductosCarrito() {
                fetch('routes/router.php?accion=obtener_carrito')
                    .then(response => response.json())
                    .then(data => {
                        carritoListaDiv.innerHTML = '';
                        let total = 0;

                        if (data.estado === 'exito' && data.productos && data.productos.length > 0) {
                            data.productos.forEach(item => {
                                const productoDiv = document.createElement('div');
                                productoDiv.classList.add('carrito-item');
                                const subtotal = parseFloat(item.precio) * item.cantidad;
                                total += subtotal;

                                productoDiv.innerHTML = `
                                    <div class="item-info">
                                        <img src="${item.imagen_url}?v=${Date.now()}" alt="${item.nombre}">
                                        <span>${item.nombre} x ${item.cantidad}</span>
                                    </div>
                                    <span class="item-precio">S/ ${subtotal.toFixed(2)}</span>
                                `;
                                carritoListaDiv.appendChild(productoDiv);
                            });
                            totalCarritoSpan.textContent = `S/ ${total.toFixed(2)}`;
                        } else {
                            carritoListaDiv.innerHTML = '<p>Aún no ha añadido ningún producto al carrito.</p>';
                            totalCarritoSpan.textContent = 'S/ 0.00';
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar productos del carrito:', error);
                        carritoListaDiv.innerHTML = '<p>Hubo un error al cargar el carrito. Intente de nuevo.</p>';
                        totalCarritoSpan.textContent = 'S/ 0.00';
                    });
            }

            cargarProductosCarrito();

            btnProcesarPago.addEventListener('click', function() {
                if (confirm('¿Desea confirmar la compra y procesar el pago?')) {
                    fetch('routes/router.php?accion=procesar_pago', {
                        method: 'POST' 
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.estado === 'exito') {
                            alert(data.mensaje);
                            cargarProductosCarrito();
                        } else {
                            alert('Error al procesar el pago: ' + data.mensaje);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la solicitud de procesar pago:', error);
                        alert('Error de conexión al procesar el pago.');
                    });
                }
            });
        });