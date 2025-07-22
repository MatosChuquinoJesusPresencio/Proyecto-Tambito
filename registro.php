<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | Tambo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/validaciones.js"></script>
</head>

<body>

    <main class="registro-main">
        <div class="login-container" style="max-width: 500px;">
            <!-- Botón de retroceso -->
            <a href="login.php" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>

            <!-- Header -->
            <div class="login-header">
                <img src="img/logo.svg" alt="Logo" class="login-logo">
                <h1>Crear Cuenta</h1>
            </div>

            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['error_message_registro'])) {
                echo '<div class="message-container error-message">' . $_SESSION['error_message_registro'] . '</div>';
                unset($_SESSION['error_message_registro']);
            }
            ?>

            <!-- Formulario -->
            <form class="login-form" action="api/guardar_usuario.php" method="POST" onsubmit="return validarRegistro()">
                <!-- Nombre -->
                <div class="input-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan" required>
                    <i class="fas fa-user input-icon"></i>
                </div>

                <!-- Apellido -->
                <div class="input-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ej: Pérez" required>
                    <i class="fas fa-user-tag input-icon"></i>
                </div>

                <!-- Edad -->
                <div class="input-group">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" placeholder="18" min="18" max="100" required>
                    <i class="fas fa-birthday-cake input-icon"></i>
                </div>

                <!-- Celular -->
                <div class="input-group">
                    <label for="celular">Número de Celular</label>
                    <input type="tel" id="celular" name="celular" placeholder="+51 987654321" required>
                    <i class="fas fa-mobile-alt input-icon"></i>
                </div>

                <!-- Dirección -->
                <div class="input-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Av. Principal 123" required>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                </div>

                <!-- Correo -->
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <!-- Contraseña -->
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="input-group">
                    <label for="confirm-password">Confirmar Contraseña</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••"
                        required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <button type="submit" class="btn-login">Registrarse</button>
            </form>

            <div class="login-footer">
                <p>¿Ya tienes cuenta? <a href="login.php" class="register-link">Inicia Sesión</a></p>
            </div>
        </div>
    </main>
</body>

</html>