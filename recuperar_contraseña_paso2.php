<?php
session_start();

// Asegurarse de que el usuario viene del paso 1
if (!isset($_SESSION['reset_user_id']) || !isset($_SESSION['reset_email'])) {
    $_SESSION['reset_error'] = "❌ Acceso no autorizado. Por favor, inicia el proceso de recuperación desde el principio.";
    header("Location: recuperar_contraseña_paso1.php");
    exit();
}

$user_email = htmlspecialchars($_SESSION['reset_email']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2: Recuperar Contraseña | Tambo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main>
        <div class="login-container" style="max-width: 450px;">
            <a href="recuperar_contraseña_paso1.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <div class="login-header">
                <img src="img/logo.svg" alt="Logo" class="login-logo">
                <h1>Recuperar Contraseña</h1>
                <p>Paso 2 de 2</p>
            </div>

            <?php
            if (isset($_SESSION['reset_error'])) {
                echo '<div class="message-container error-message">' . $_SESSION['reset_error'] . '</div>';
                unset($_SESSION['reset_error']);
            }
            ?>

            <form class="login-form" action="api/verify_age_for_reset.php" method="POST">
                <p style="text-align: center; margin-bottom: 20px;">
                    Verifica tu identidad ingresando tu edad registrada para **<?php echo $user_email; ?>**.
                </p>
                <div class="input-group" style="display: none;">
                    <label for="email_hidden">Correo electrónico</label>
                    <input type="hidden" id="email_hidden" name="email" value="<?php echo $user_email; ?>">
                </div>
                <div class="input-group">
                    <label for="edad_ingresada">Tu Edad</label>
                    <input type="number" id="edad_ingresada" name="edad_ingresada" placeholder="Ej: 25" min="1" max="100" required>
                    <i class="fas fa-question-circle input-icon"></i>
                </div>
                <button type="submit" class="btn-login">Verificar y Cambiar Contraseña</button>
            </form>

            <div class="login-footer">
                <p>¿Recordaste tu contraseña? <a href="login.php" class="register-link">Inicia Sesión</a></p>
            </div>
        </div>
    </main>
</body>
</html>