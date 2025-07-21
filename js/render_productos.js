function renderizarProductos(data) {
  const contenedor = document.querySelector('.product-content');
  if (!contenedor) return;

  contenedor.innerHTML = '';

  const selectedCategory = localStorage.getItem('selectedCategory');

  localStorage.removeItem('selectedCategory');

  for (const categoria in data) {
    const productos = data[categoria].productos || [];
    if (productos.length === 0) continue;

    if (selectedCategory && categoria !== selectedCategory) {
        continue;
    }

    const seccion = document.createElement('section');
    seccion.classList.add('category-section');

    const header = `
      <div class="category-header">
        <h2 class="category-title">${categoria}</h2>
      </div>
    `;

    const productosHTML = productos.map(producto => {
      console.log(producto);

      const discountBadge = producto.descuento ? `<div class="product-badge">-${producto.descuento}%</div>` : '';

      return `
        <div class="product-card" data-product='${JSON.stringify(producto)}'> ${discountBadge}
          <div class="product-image">
            <img src="${producto.imagen_url}?v=${Date.now()}" alt="${producto.nombre}" loading="lazy">
          </div>
          <div class="product-info">
            <h3 class="product-name">${producto.nombre}</h3>
            <div class="product-footer">
              <div class="product-price">
                <span class="current-price">S/ ${parseFloat(producto.precio).toFixed(2)}</span>
              </div>
              <button class="add-to-cart" data-product-id="${producto.codigo}">+</button>
            </div>
          </div>
        </div>
      `;
    }).join('');

    seccion.innerHTML = header + `<div class="products-grid">${productosHTML}</div>`;
    contenedor.appendChild(seccion);
  }

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
}

function cargarYRenderizar() {
  fetch('api/render.php')
    .then(res => res.json())
    .then(data => {
      console.log("📦 Datos cargados desde JSON:", data);
      renderizarProductos(data);
    })
    .catch(err => {
      console.error("❌ Error cargando productos:", err);
    });
}

document.addEventListener('DOMContentLoaded', cargarYRenderizar);
document.addEventListener('productosActualizados', cargarYRenderizar);

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