<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Tambo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/login.js"></script>
</head>

<body>
    <main>
        <div class="login-container">
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div class="login-header">
                <img src="img/logo.svg" alt="Logo" class="login-logo">
                <h1>Bienvenido de vuelta</h1>
            </div>

            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['success_message_login'])) {
                echo '<div class="message-container success-message">' . $_SESSION['success_message_login'] . '</div>';
                unset($_SESSION['success_message_login']);
            }

            if (isset($_SESSION['error_message'])) {
                echo '<div class="message-container error-message">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>

            <form class="login-form" action="api/validar_usuario.php" method="POST" onsubmit="return validarLogin()">
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <button type="submit" class="btn-login">Ingresar</button>

                <div class="login-options">
                    <a href="recuperar_contraseña_paso1.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
            </form>

            <div class="login-footer">
                <p>¿No tienes cuenta? <a href="registro.php" class="register-link">Regístrate aquí</a></p>
            </div>
        </div>
    </main>

</body>

</html>