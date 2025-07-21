document.addEventListener('DOMContentLoaded', function () {
    fetch('api/render.php')
        .then(res => res.json())
        .then(data => {
            const contenedor = document.querySelector('.hero-content');

            for (const categoria in data) {
                const seccion = document.createElement('section');
                seccion.classList.add('category-section');

                const header = `
                    <div class="category-header">
                        <h2 class="category-title">${categoria}</h2>
                        <a href="productos.php" class="view-all" data-category="${categoria}">Ver más <i class="fas fa-chevron-right"></i></a>
                    </div>
                `;

                const btnVerMas = `
                    <a href="productos.php" class="vermas-card" data-category="${categoria}">
                        <div class="icon-container">
                            <div class="boton-mas"></div>
                        </div>
                        <div class="text-vermas">Ver más</div>
                    </a>
                `;

                let productosHTML = '';

                const productosMostrados = data[categoria].productos.slice(0, 7);

                productosMostrados.forEach(prod => {
                    const discountBadge = prod.descuento ? `<div class="product-badge">-${prod.descuento}%</div>` : '';

                    productosHTML += `
                        <div class="product-card" data-product='${JSON.stringify(prod)}'> ${discountBadge}
                            <div class="product-image">
                                <img src="${prod.imagen_url}?v=${Date.now()}" alt="${prod.nombre}">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">${prod.nombre}</h3>
                                <div class="product-footer">
                                    <div class="product-price">
                                        <span class="current-price">S/ ${parseFloat(prod.precio).toFixed(2)}</span>
                                    </div>
                                    <button class="add-to-cart" data-product-id="${prod.codigo}">+</button>
                                </div>
                            </div>
                        </div>
                    `;
                });

                seccion.innerHTML = header + `<div class="product-carousel">${productosHTML}${btnVerMas} </div>`;
                contenedor.appendChild(seccion);
            }

            document.querySelectorAll('.view-all, .vermas-card').forEach(button => {
                button.addEventListener('click', function(event) {
                    const category = this.dataset.category;
                    localStorage.setItem('selectedCategory', category);
                });
            });

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    if (event.target.classList.contains('add-to-cart')) {
                        return;
                    }
                    const productData = JSON.parse(this.dataset.product);
                    window.openProductModal(productData);
                });
            });

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const productCard = this.closest('.product-card');
                    const productData = JSON.parse(productCard.dataset.product);
                    añadirProductoAlCarrito(productData);
                });
            });

        })
        .catch(err => {
            console.error("❌ Error cargando categorías:", err);
        });
});

function añadirProductoAlCarrito(producto, cantidad = 1) { 
    fetch('routes/router.php?accion=añadir_carrito', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ ...producto, cantidad_deseada: parseInt(cantidad) })
    })
    .then(response => response.json())
    .then(data => {
        if (data.estado === 'exito') {
            console.log('Producto añadido al carrito:', data.mensaje);
            if (typeof actualizarCarritoVisual === 'function') {
                actualizarCarritoVisual();
            }
            document.getElementById('cart-toggle').checked = true;
        } else {
            console.error('Error al añadir producto al carrito:', data.mensaje);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud de añadir al carrito:', error);
    });
}

function actualizarCarritoVisual() {
    fetch('routes/router.php?accion=obtener_carrito')
        .then(response => response.json())
        .then(data => {
            const cartList = document.querySelector('.cart-sidebar ul');
            cartList.innerHTML = '';
            if (data.productos && data.productos.length > 0) {
                data.productos.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = `${item.nombre} - S/ ${(parseFloat(item.precio) * item.cantidad).toFixed(2)} (${item.cantidad} unidades)`;
                    cartList.appendChild(li);
                });
            } else {
                cartList.innerHTML = '<li>El carrito está vacío.</li>';
            }
        })
        .catch(error => {
            console.error('Error al obtener productos del carrito para actualizar vista:', error);
        });
}