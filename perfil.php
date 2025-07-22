<?php
// Incluir la lógica del perfil al principio
include 'api/perfil_logic.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil | Tambo+</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/pages/perfil.css"> </head>

<body class="perfil-body">
    <?php include 'header.php'; ?>

    <main>
        <div class="hero-banner perfil-bg">
        <div class="hero-content">
        <div class="profile-container">
            <h1>Mi Perfil</h1>

            <?php if (!empty($message)) : ?>
                <div class="message-container <?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="profile-actions">
                <button id="view-profile-btn" class="btn-action active-btn">Ver Perfil</button>
                <button id="edit-profile-btn" class="btn-action">Editar Perfil</button>
                <button id="change-password-btn" class="btn-action">Cambiar Contraseña</button>
                <a href="api/logout.php" class="btn-action btn-logout">Cerrar Sesión</a>
            </div>

            <div id="view-profile-section" class="profile-section active-section">
                <div class="profile-info-group">
                    <strong>Nombre:</strong> <span><?php echo $nombre; ?></span>
                </div>
                <div class="profile-info-group">
                    <strong>Apellido:</strong> <span><?php echo $apellido; ?></span>
                </div>
                <div class="profile-info-group">
                    <strong>Correo Electrónico:</strong> <span><?php echo $email; ?></span>
                </div>
                <div class="profile-info-group">
                    <strong>Edad:</strong> <span><?php echo $edad; ?></span>
                </div>
                <div class="profile-info-group">
                    <strong>Celular:</strong> <span><?php echo $celular; ?></span>
                </div>
                <div class="profile-info-group">
                    <strong>Dirección:</strong> <span><?php echo $direccion; ?></span>
                </div>
            </div>

            <div id="edit-profile-section" class="profile-section">
                <form action="perfil.php" method="POST" id="edit-profile-form">
                    <input type="hidden" name="action" value="update_profile">
                    <div class="form-group">
                        <label for="nombre_edit">Nombre:</label>
                        <input type="text" id="nombre_edit" name="nombre" value="<?php echo $nombre; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_edit">Apellido:</label>
                        <input type="text" id="apellido_edit" name="apellido" value="<?php echo $apellido; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email_edit">Correo Electrónico:</label>
                        <input type="email" id="email_edit" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="edad_edit">Edad:</label>
                        <input type="number" id="edad_edit" name="edad" value="<?php echo $edad; ?>" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="celular_edit">Celular:</label>
                        <input type="text" id="celular_edit" name="celular" value="<?php echo $celular; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_edit">Dirección:</label>
                        <input type="text" id="direccion_edit" name="direccion" value="<?php echo $direccion; ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-update">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <div id="change-password-section" class="profile-section">
                <form action="perfil.php" method="POST" id="change-password-form">
                    <input type="hidden" name="action" value="change_password">
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" id="new_password" name="new_password" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-update">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    </main>

    <?php include 'footer.php'; // Si tienes un footer, inclúyelo aquí ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewProfileBtn = document.getElementById('view-profile-btn');
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const changePasswordBtn = document.getElementById('change-password-btn');

            const viewProfileSection = document.getElementById('view-profile-section');
            const editProfileSection = document.getElementById('edit-profile-section');
            const changePasswordSection = document.getElementById('change-password-section');

            const allSections = [viewProfileSection, editProfileSection, changePasswordSection];
            const allButtons = [viewProfileBtn, editProfileBtn, changePasswordBtn];

            function showSection(sectionToShow, buttonToActivate) {
                allSections.forEach(section => section.classList.remove('active-section'));
                allButtons.forEach(button => button.classList.remove('active-btn'));

                sectionToShow.classList.add('active-section');
                buttonToActivate.classList.add('active-btn');
            }

            viewProfileBtn.addEventListener('click', () => showSection(viewProfileSection, viewProfileBtn));
            editProfileBtn.addEventListener('click', () => showSection(editProfileSection, editProfileBtn));
            changePasswordBtn.addEventListener('click', () => showSection(changePasswordSection, changePasswordBtn));

            // Si hay un mensaje de éxito/error después de un POST, la página se recarga.
            // Aquí podemos determinar qué sección mostrar por defecto en base al último POST.
            // Para simplificar, si hay un mensaje, siempre volvemos a la vista de perfil.
            // O podrías pasar un parámetro URL para mantener la sección activa.
            <?php if (!empty($message_type)) : ?>
                // Si hubo un mensaje, asumimos que se intentó una acción, pero por simplicidad,
                // volvemos a la vista del perfil para mostrar el mensaje.
                // Si quisieras que el formulario de edición o cambio de contraseña se mantenga abierto,
                // deberías pasar un parámetro en la URL y leerlo aquí.
                showSection(viewProfileSection, viewProfileBtn);
            <?php endif; ?>
        });
    </script>
</body>

</html>