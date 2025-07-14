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
    <?php include 'header.php'; ?>

    <main>
        <div class="hero-banner home-bg">
            <div class="hero-content">
                <img src="img/logo.svg" alt="Tambo" class="main-logo">
                <h2 class="hero-slogan" id="hero-slogan">CADA VEZ MÁS CERCA</h2>
                <a href="registro.php" class="register-btn">Registrarse</a>

                <div class="triangle-container">
                    <div class="category side-left">
                        <span id="categoria-comidas-span">COMIDAS</span>
                        <img id="categoria-comidas-img" src="img/comidas.png" alt="Comidas">
                    </div>
                    <div class="category side-right">
                        <span id="categoria-bebidas-span">BEBIDAS</span>
                        <img id="categoria-bebidas-img" src="img/bebidas.webp" alt="Bebidas">
                    </div>

                    <div class="category mid-left">
                        <span id="categoria-antojos-span">ANTOJOS</span>
                        <img id="categoria-antojos-img" src="img/antojos.png" alt="Antojos">
                    </div>
                    <div class="category mid-right">
                        <span id="categoria-despensa-span">DESPENSA</span>
                        <img id="categoria-despensa-img" src="img/despensa.webp" alt="Despensa">
                    </div>

                    <div class="category top-center">
                        <span id="categoria-helado-span">HELADO</span>
                        <img id="categoria-helado-img" src="img/helado.png" alt="Helado">
                    </div>
                </div>
            </div>
        </div>

        <div class="promo-banner">
            <section class="promo-section">
                <h2 class="section-title">PROMOCIONES</h2>
                <div class="static-carousel">
                    <!-- Tarjeta 1 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-1.jpg" alt="30% OFF en Lácteos" class="promo-img">
                        <div class="promo-badge">-30%</div>
                        <div class="promo-overlay">
                            <p class="promo-text">LÁCTEOS FRESCOS</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-2.avif" alt="2x1 en Helados" class="promo-img">
                        <div class="promo-badge">2x1</div>
                        <div class="promo-overlay">
                            <p class="promo-text">HELADOS ARTESANALES</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-3.jpg" alt="25% OFF en Despensa" class="promo-img">
                        <div class="promo-badge">-25%</div>
                        <div class="promo-overlay">
                            <p class="promo-text">DESPENSA</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-4.jpg" alt="15% OFF en Snacks" class="promo-img">
                        <div class="promo-badge">-15%</div>
                        <div class="promo-overlay">
                            <p class="promo-text">SNACKS</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 5 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-5.jpg" alt="3x2 en Bebidas" class="promo-img">
                        <div class="promo-badge">3x2</div>
                        <div class="promo-overlay">
                            <p class="promo-text">BEBIDAS</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 6 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-6.jpg" alt="40% OFF en Congelados" class="promo-img">
                        <div class="promo-badge">-40%</div>
                        <div class="promo-overlay">
                            <p class="promo-text">CONGELADOS</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 7 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-7.jpg" alt="Envío Gratis" class="promo-img">
                        <div class="promo-badge">GRATIS</div>
                        <div class="promo-overlay">
                            <p class="promo-text">DELIVERY GRATIS - YAPE</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>

                    <!-- Tarjeta 8 -->
                    <div class="promo-card">
                        <img src="img/PROMOCIONES/promo-8.jpg" alt="20% OFF en Frutas" class="promo-img">
                        <div class="promo-badge">-20%</div>
                        <div class="promo-overlay">
                            <p class="promo-text">FRUTAS</p>
                            <button class="promo-btn">VER OFERTA</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="js/inicio.js"></script>

</body>

</html>