<?php
session_start();

if (!isset($_SESSION['reset_user_id'])) {
    $_SESSION['reset_error'] = "❌ Acceso no autorizado. Por favor, inicia el proceso de recuperación desde el principio.";
    header("Location: recuperar_contraseña_paso1.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecer Nueva Contraseña | Tambo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/validaciones.js"></script> 
</head>
<body>
    <main>
        <div class="login-container" style="max-width: 450px;">
            <a href="login.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div class="login-header">
                <img src="img/logo.svg" alt="Logo" class="login-logo">
                <h1>Establecer Nueva Contraseña</h1>
            </div>

            <?php
            if (isset($_SESSION['reset_error'])) {
                echo '<div class="message-container error-message">' . $_SESSION['reset_error'] . '</div>';
                unset($_SESSION['reset_error']);
            }
            ?>

            <form class="login-form" action="api/update_password.php" method="POST" onsubmit="return validarNuevaContrasena()">
                <p style="text-align: center; margin-bottom: 20px;">
                    Ingresa tu nueva contraseña.
                </p>
                <div class="input-group">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <div class="input-group">
                    <label for="confirm_new_password">Confirmar Nueva Contraseña</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <button type="submit" class="btn-login">Cambiar Contraseña</button>
            </form>

            <div class="login-footer">
                <p>¿Recordaste tu contraseña? <a href="login.php" class="register-link">Inicia Sesión</a></p>
            </div>
        </div>
    </main>
</body>
</html>