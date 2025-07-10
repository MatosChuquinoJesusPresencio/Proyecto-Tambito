document.addEventListener('DOMContentLoaded', () => {
    const modalHTML = `
        <div id="productModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <div class="modal-body">
                    <div class="modal-image-container">
                        <img id="modal-product-image" src="" alt="Imagen del Producto">
                    </div>
                    <div class="modal-details">
                        <h2 id="modal-product-name"></h2>
                        <div class="modal-price-container">
                            <p class="modal-current-price">S/ <span id="modal-product-price"></span></p>
                            <p class="modal-old-price" id="modal-product-old-price"></p>
                        </div>
                        <div class="modal-discount-badge" id="modal-product-discount"></div>
                        <div class="modal-quantity-selector">
                            <label for="modal-quantity">Cantidad:</label>
                            <div class="quantity-control">
                                <button id="quantity-minus">-</button>
                                <input type="number" id="modal-quantity" value="1" min="1">
                                <button id="quantity-plus">+</button>
                            </div>
                        </div>
                        <button class="add-to-cart-modal">Añadir al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    const modal = document.getElementById('productModal');
    const closeButton = document.querySelector('.close-button');
    const quantityInput = document.getElementById('modal-quantity');
    const quantityMinus = document.getElementById('quantity-minus');
    const quantityPlus = document.getElementById('quantity-plus');

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Controles de cantidad
    quantityMinus.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    quantityPlus.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });

    // Función para abrir el modal con los datos del producto
    window.openProductModal = (product) => {
        document.getElementById('modal-product-image').src = product.imagen_url + '?v=' + Date.now();
        document.getElementById('modal-product-name').textContent = product.nombre;
        document.getElementById('modal-product-price').textContent = parseFloat(product.precio).toFixed(2);
        quantityInput.value = 1;

        const oldPriceElement = document.getElementById('modal-product-old-price');
        const discountBadgeElement = document.getElementById('modal-product-discount');

        if (product.precio_anterior && product.descuento) {
            oldPriceElement.textContent = `S/ ${parseFloat(product.precio_anterior).toFixed(2)}`;
            oldPriceElement.style.textDecoration = 'line-through';
            oldPriceElement.style.color = '#888';
            discountBadgeElement.textContent = `-${product.descuento}%`;
            discountBadgeElement.style.display = 'block';
        } else {
            oldPriceElement.textContent = '';
            oldPriceElement.style.textDecoration = 'none';
            oldPriceElement.style.color = 'inherit';
            discountBadgeElement.style.display = 'none';
        }

        modal.style.display = 'flex';
    };

    // Funcionalidad de añadir al carrito (ejemplo básico, integrar con tu lógica de carrito real)
    const addToCartModalButton = document.querySelector('.add-to-cart-modal');
    addToCartModalButton.addEventListener('click', () => {
        const productName = document.getElementById('modal-product-name').textContent;
        const productPrice = document.getElementById('modal-product-price').textContent;
        const quantity = quantityInput.value;
        alert(`Añadido al carrito: ${quantity} x ${productName} (S/ ${productPrice} c/u)`);
        modal.style.display = 'none'; 
    });
});