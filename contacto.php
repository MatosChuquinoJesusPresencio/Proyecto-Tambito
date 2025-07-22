<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Tambo+</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/contacto.js"></script>
    <script src="js/Form_Contacto.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
 
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="hero-banner contact-bg">
            <div class="hero-content">
                <section class="contact-section">
                    <h2>Información de Contacto</h2>
                    <div class="contact-grid">
                        <div class="contact-details">
                            <p><strong>Teléfono:</strong> <span id="contacto-telefono">(01) 6124999</span></p>
                            <p><strong>Correo Electrónico:</strong> <span id="contacto-email">contacto@tambo.com</span></p>
                            <p><strong>Instagram:</strong> <a id="contacto-instagram-link" href="https://www.instagram.com/tiendas_tambo/"
                                    target="_blank"><span id="contacto-instagram-text">tiendas_tambo</span></a></p>
                            <p><strong>Facebook:</strong> <a id="contacto-facebook-link" href="https://www.facebook.com/TamboMas/"
                                    target="_blank"><span id="contacto-facebook-text">Tambo +</span></a></p>
                            <p><strong>TikTok:</strong> <a id="contacto-tiktok-link" href="https://www.tiktok.com/@tiendas_tambo"
                                    target="_blank"><span id="contacto-tiktok-text">tiendas_tambo</span></a></p>
                            <p><strong>Horario:</strong> <span id="contacto-horario">Lunes a Domingo, 7:00 a.m. – 11:00 p.m.</span></p>
                        </div>
                        <div class="map-container">
                            <h3>Encuéntranos</h3>
                            <div class="mapa">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15609.95764434293!2d-77.03816654999999!3d-12.04637485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c8c5a2c4e3f3%3A0x4a9d7b4a2e3b2e3!2sPlaza%20Mayor%20de%20Lima!5e0!3m2!1ses-419!2spe!4v1716601234567!5m2!1ses-419!2spe"
                                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="feedback-section">
                    <h2>Envíanos tus Comentarios o Sugerencias</h2>
                    <p class="section-description">Tu opinión es importante para nosotros. Ayúdanos a mejorar.</p>
                    <form class="contact-form">
                        <div class="form-group">
                            <label for="feedback-name">Nombre:</label>
                            <input type="text" id="feedback-name" name="feedback-name" placeholder="Tu nombre completo"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="feedback-email">Correo Electrónico:</label>
                            <input type="email" id="feedback-email" name="feedback-email"
                                placeholder="ejemplo@correo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="feedback-message">Mensaje:</label>
                            <textarea id="feedback-message" name="feedback-message" rows="6"
                                placeholder="Escribe aquí tu comentario o sugerencia..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Enviar Comentario</button>
                    </form>
                </section>

                <section class="join-team-section">
                    <div class="join-team-content">
                        <div class="join-team-text">
                            <h2>Sé parte de nuestro equipo</h2>
                            <p>Buscamos talento como tú para trabajar en la Tienda del Perú. ¡Únete a la familia Tambo+!
                            </p>
                        </div>
                        <div class="join-team-image">
                            <img src="img/contacto-trabajo.webp" alt="Únete a nuestro equipo" class="responsive-img">
                        </div>
                    </div>
                    <p class="section-description">Completa el siguiente formulario para postularte a nuestras vacantes.
                    </p>
                    <form class="application-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="app-name">Nombre:</label>
                                <input type="text" id="app-name" name="app-name" placeholder="Tu nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="app-lastname">Apellido:</label>
                                <input type="text" id="app-lastname" name="app-lastname" placeholder="Tu apellido"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="app-dni">DNI:</label>
                                <input type="text" id="app-dni" name="app-dni" placeholder="Ej. 12345678" required>
                            </div>
                            <div class="form-group">
                                <label for="app-email">Correo Electrónico:</label>
                                <input type="email" id="app-email" name="app-email" placeholder="ejemplo@correo.com"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="app-phone">Celular:</label>
                                <input type="tel" id="app-phone" name="app-phone" placeholder="Ej. 987654321" required>
                            </div>
                            <div class="form-group">
                                <label for="app-department">Departamento:</label>
                                <input type="text" id="app-department" name="app-department" placeholder="Ej. Lima"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="app-province">Provincia:</label>
                                <input type="text" id="app-province" name="app-province" placeholder="Ej. Lima"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="app-district">Distrito:</label>
                                <input type="text" id="app-district" name="app-district" placeholder="Ej. Miraflores"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="app-address">Dirección:</label>
                            <input type="text" id="app-address" name="app-address"
                                placeholder="Av. Principal 123, Urb. Los Álamos" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="app-work-district">Distrito donde quieres trabajar:</label>
                                <input type="text" id="app-work-district" name="app-work-district"
                                    placeholder="Ej. San Isidro">
                            </div>
                            <div class="form-group">
                                <label for="app-schedule">Horarios que quieres trabajar:</label>
                                <input type="text" id="app-schedule" name="app-schedule"
                                    placeholder="Ej. Mañana/Tarde, Tiempo completo">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">Enviar Postulación</button>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>


</html>