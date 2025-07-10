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
        <h2 class="category-title">Productos de Categoría ${categoria}</h2>
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
              <button class="add-to-cart">+</button>
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
}

function cargarYRenderizar() {
  fetch('api/categorias.php')
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