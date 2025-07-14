<!-- header.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Home | Tambo+</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
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
                        <h2>Tu carrito</h2>
                        <ul>
                            <li>Producto 1 - $10</li>
                            <li>Producto 2 - $15</li>
                            <li>Producto 3 - $20</li>
                        </ul>
                        <a href="carrito.php" class="checkout-button-carrito">Pagar</a>
                    </div>
                </div>

                <div class="login-icon">
                    <a href="login.php" class="login-icon">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>
        </nav>
    </header>
