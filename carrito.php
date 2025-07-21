<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Carrito | Tambo+</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/carrito.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="hero-banner carrito-bg">
            <div class="hero-content">
                <div class="carrito-contenido">
                    <h1 class="titulo-carrito">Tus Compras</h1>
                    <div class="carrito-listado" id="carrito-productos-lista">
                        <p>Cargando productos del carrito...</p>
                    </div>
                    <div class="carrito-resumen">
                        <p>Total: <span id="total-carrito">S/ 0.00</span></p>
                        <button id="btn-procesar-pago" class="checkout-button-carrito">Procesar Pago</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>