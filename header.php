<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Inicio | Tambo+</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/pages/sesion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.svg" alt="Logo">
                </a>
            </div>

            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="menu-icon">
                <i class="fas fa-bars"></i>
            </label>

            <div class="nav-links">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="categorias.php">Categorías</a></li>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </div>

            <div class="nav-right">
                <div class="search-container" tabindex="0">
                    <input type="text" placeholder="Buscar...">
                    <i class="fas fa-search"></i>
                </div>

                <div class="cart-container">
                    <input type="checkbox" id="cart-toggle" class="cart-toggle">

                    <label for="cart-toggle" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </label>

                    <label for="cart-toggle" class="overlay-cart"></label>

                    <div class="cart-sidebar">
                        <h2 class="titulo-carrito-slidebar">Tu carrito</h2>
                        <ul id="cart-items-list">
                            </ul>
                        <a href="carrito.php" class="checkout-button-carrito">Pagar</a>
                        <button id="vaciar-carrito-btn" class="vaciar-carrito-btn">Vaciar Carrito</button>
                    </div>
                </div>

                <div class="login-icon">
                    <?php
                    // Verificar si el usuario está logueado
                    if (isset($_SESSION['id'])) {
                        // Si el usuario tiene rol 'usuario', mostrar el menú desplegable
                        if ($_SESSION['rol'] === 'usuario') {
                    ?>
                            <div class="user-menu-container">
                                <span class="user-name-display">
                                    <i class="fas fa-user"></i>
                                    <?php echo htmlspecialchars(strtok($_SESSION['nombre'], ' ') ); ?>
                                </span>
                                <div class="user-dropdown-menu">
                                    <p>Hola, <br><strong><?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></strong></p>
                                    <a href="perfil.php" class="dropdown-item perfil-btn"><i class="fas fa-user-circle"></i> Ver Perfil</a>
                                    <a href="api/logout.php" class="dropdown-item logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                                </div>
                            </div>
                        <?php
                        } else if ($_SESSION['rol'] === 'admin') {
                            // Si el usuario es 'admin', redirigir al panel de administración
                        ?>
                            <a href="administracion.php" class="user-name-display">
                                <i class="fas fa-user"></i>
                                <span>Admin</span>
                            </a>
                        <?php
                        }
                    } else {
                        // Si el usuario NO está logueado, mostrar el enlace normal de inicio de sesión
                        ?>
                        <a href="login.php" class="login-link">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuContainer = document.querySelector('.user-menu-container');
            if (userMenuContainer) {
                const userNameDisplay = userMenuContainer.querySelector('.user-name-display');
                const userDropdownMenu = userMenuContainer.querySelector('.user-dropdown-menu');

                userNameDisplay.addEventListener('click', function() {
                    userDropdownMenu.classList.toggle('active');
                });

                // Cerrar el menú si se hace clic fuera de él
                document.addEventListener('click', function(event) {
                    if (!userMenuContainer.contains(event.target)) {
                        userDropdownMenu.classList.remove('active');
                    }
                });
            }

            // Función para actualizar la vista del carrito en el sidebar
            function actualizarCarritoVisual() {
                fetch('routes/router.php?accion=obtener_carrito')
                    .then(response => response.json())
                    .then(data => {
                        const cartList = document.getElementById('cart-items-list');
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

            // Cargar el carrito al cargar la página
            actualizarCarritoVisual();

            // Evento para el botón "Vaciar Carrito"
            const vaciarCarritoBtn = document.getElementById('vaciar-carrito-btn');
            if (vaciarCarritoBtn) {
                vaciarCarritoBtn.addEventListener('click', function() {
                    if (confirm('¿Estás seguro de que quieres vaciar el carrito?')) {
                        fetch('routes/router.php?accion=vaciar_carrito')
                            .then(response => response.json())
                            .then(data => {
                                if (data.estado === 'exito') {
                                    alert(data.mensaje);
                                    actualizarCarritoVisual();
                                } else {
                                    alert('Error al vaciar el carrito: ' + data.mensaje);
                                }
                            })
                            .catch(error => {
                                console.error('Error al vaciar carrito:', error);
                                alert('Error de conexión al vaciar el carrito.');
                            });
                    }
                });
            }
        });
    </script>
</body>

</html>