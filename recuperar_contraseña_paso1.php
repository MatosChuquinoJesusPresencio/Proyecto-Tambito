<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 1: Recuperar Contraseña | Tambo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main>
        <div class="login-container" style="max-width: 450px;">
            <a href="login.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div class="login-header">
                <img src="img/logo.svg" alt="Logo" class="login-logo">
                <h1>Recuperar Contraseña</h1>
                <p>Paso 1 de 2</p>
            </div>

            <?php
            session_start();
            if (isset($_SESSION['reset_error'])) {
                echo '<div class="message-container error-message">' . $_SESSION['reset_error'] . '</div>';
                unset($_SESSION['reset_error']);
            }
            ?>

            <form class="login-form" action="api/verify_email_for_reset.php" method="POST">
                <p style="text-align: center; margin-bottom: 20px;">
                    Ingresa tu correo electrónico para continuar con el restablecimiento.
                </p>
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                <button type="submit" class="btn-login">Siguiente</button>
            </form>

            <div class="login-footer">
                <p>¿Recordaste tu contraseña? <a href="login.php" class="register-link">Inicia Sesión</a></p>
            </div>
        </div>
    </main>
</body>
</html>