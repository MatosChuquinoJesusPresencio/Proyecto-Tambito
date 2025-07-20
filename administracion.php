<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administracion | Tambo</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/pages/administracion.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="js/guardarNosotros.js"></script>
  <script src="js/admin_categorias.js"></script>
  <script src="js/guardarInicio.js"></script>
  <script src="js/guardarContacto.js"></script>
</head>

<body class="body-admin">

  <div class="content-admin">

    <!-- Botones donde se encuentran las opciones -->
    <input type="radio" name="tab" id="tab-inicio" checked>
    <input type="radio" name="tab" id="tab-nosotros">
    <input type="radio" name="tab" id="tab-contacto">
    <input type="radio" name="tab" id="tab-categoria">
    

    <!--  Logo y opciones-->
    <div class="sidebar-admin">

      <div class="logo">
        <a href="index.php">
          <img src="img/logo.svg" alt="Logo">
        </a>
      </div>

      <h2>Admin. Secciones</h2>

      <h3 class="admin-info">
        Bienvenido, <?php echo $_SESSION['nombre']; ?>
      </h3>


      <nav>
        <label for="tab-inicio">Inicio</label>
        <label for="tab-nosotros">Nosotros</label>
        <label for="tab-contacto">Contacto</label>
        <label for="tab-categoria">Categoría</label>
      </nav>

      <a href="logout.php" class="cerrar-sesion">Cerrar sesión</a>


    </div>

    <div class="main-admin">

      <!-- Inicio -->
      <section id="inicio">
        <div class="titulo-admin">
          <h1>INICIO</h1>
        </div>

        <div class="inicio-opciones">
          <div class="editar-eslogan">
            <h2 class="subtitulo">Editar Eslogan</h2>
            <input class="cambiar-eslogan" type="text" id="admin-eslogan" placeholder="CADA VEZ MAS CERCA">
            <div class="boton-admin">
              <button class="save" id="guardar-eslogan">Guardar Eslogan</button>
            </div>
          </div>

          <div class="editar-categorias">
            <h2>Editar Categorías Destacadas</h2>

            <div class="tipo-categoria">
              <label for="admin-categoria-1-nombre">Categoría 1 (Nombre):</label>
              <input type="text" id="admin-categoria-1-nombre" placeholder="Comidas">
              <label for="admin-categoria-1-imagen">Categoría 1 (Imagen):</label>
              <input type="file" id="admin-categoria-1-imagen" accept="image/*">
              <input type="hidden" id="admin-categoria-1-imagen-actual" value="">
            </div>

            <div class="tipo-categoria">
              <label for="admin-categoria-2-nombre">Categoría 2 (Nombre):</label>
              <input type="text" id="admin-categoria-2-nombre" placeholder="Antojos">
              <label for="admin-categoria-2-imagen">Categoría 2 (Imagen):</label>
              <input type="file" id="admin-categoria-2-imagen" accept="image/*">
              <input type="hidden" id="admin-categoria-2-imagen-actual" value="">
            </div>

            <div class="tipo-categoria">
              <label for="admin-categoria-3-nombre">Categoría 3 (Nombre):</label>
              <input type="text" id="admin-categoria-3-nombre" placeholder="Helados">
              <label for="admin-categoria-3-imagen">Categoría 3 (Imagen):</label>
              <input type="file" id="admin-categoria-3-imagen" accept="image/*">
              <input type="hidden" id="admin-categoria-3-imagen-actual" value="">
            </div>

            <div class="tipo-categoria">
              <label for="admin-categoria-4-nombre">Categoría 4 (Nombre):</label>
              <input type="text" id="admin-categoria-4-nombre" placeholder="Despensa">
              <label for="admin-categoria-4-imagen">Categoría 4 (Imagen):</label>
              <input type="file" id="admin-categoria-4-imagen" accept="image/*">
              <input type="hidden" id="admin-categoria-4-imagen-actual" value="">
            </div>

            <div class="tipo-categoria">
              <label for="admin-categoria-5-nombre">Categoría 5 (Nombre):</label>
              <input type="text" id="admin-categoria-5-nombre" placeholder="Bebidas">
              <label for="admin-categoria-5-imagen">Categoría 5 (Imagen):</label>
              <input type="file" id="admin-categoria-5-imagen" accept="image/*">
              <input type="hidden" id="admin-categoria-5-imagen-actual" value="">
            </div>

            <div class="boton-admin">
              <button class="save" id="guardar-categorias-home">Guardar Categorías</button>
            </div>
          </div>
      </section>

      <!-- Sección Nosotros -->
      <section id="nosotros">
        <div class="titulo-admin">
          <h1>NOSOTROS</h1>
        </div>
        <div class="nosotros-opciones">
          <h2 class="subtitulo">Editar Nosotros</h2>
          <form id="form-nosotros" enctype="multipart/form-data">
            <input type="text" id="nosotros-titulo" placeholder="NOSOTROS">
            <textarea id="nosotros-descripcion" placeholder="..."></textarea>
            <input type="file" id="nosotros-imagen" accept="image/*">
            <img id="preview-nosotros" src="img/default-icon.png" alt="Vista previa" style="max-width:100px;">
          </form>

          <h2 class="subtitulo">Editar Misión</h2>
          <form id="form-mision" enctype="multipart/form-data">
            <input type="text" id="mision-titulo" placeholder="MISIÓN">
            <textarea id="mision-descripcion" placeholder="..."></textarea>
            <input type="file" id="mision-imagen" accept="image/*">
            <img id="preview-mision" src="img/default-icon.png" alt="Vista previa" style="max-width:100px;">
          </form>

          <h2 class="subtitulo">Editar Visión</h2>
          <form id="form-vision" enctype="multipart/form-data">
            <input type="text" id="vision-titulo" placeholder="VISIÓN">
            <textarea id="vision-descripcion" placeholder="..."></textarea>
            <input type="file" id="vision-imagen" accept="image/*">
            <img id="preview-vision" src="img/default-icon.png" alt="Vista previa" style="max-width:100px;">
          </form>

          <!-- Botón único para guardar todo -->
          <div class="boton-admin">
            <button id="guardar-todo" class="save">GUARDAR</button>
          </div>

        </div>
      </section>

      <!-- Contacto -->
      <section id="contacto">

        <div class="titulo-admin">
          <h1>CONTACTO</h1>
        </div>
        <div class="contacto-opciones">

          <h2 class="subtitulo">Editar Contacto</h2>

          <div class="editar-contacto">

            <div>
              <label for="admin-contacto-horario">Horario de atención:</label>
              <input type="text" id="admin-contacto-horario" placeholder="Horario de atención">

              <label for="admin-contacto-telefono">Teléfono:</label>
              <input type="text" id="admin-contacto-telefono" placeholder="Teléfono">

              <label for="admin-contacto-email">Email:</label>
              <input type="text" id="admin-contacto-email" placeholder="Email">
            </div>

            <div>
              <label for="admin-contacto-instagram-url">URL de Instagram:</label>
              <input type="text" id="admin-contacto-instagram-url" placeholder="Ej. https://instagram.com/usuario">

              <label for="admin-contacto-instagram-text">Texto de Instagram:</label>
              <input type="text" id="admin-contacto-instagram-text" placeholder="Ej. tiendas_tambo">

              <label for="admin-contacto-facebook-url">URL de Facebook:</label>
              <input type="text" id="admin-contacto-facebook-url" placeholder="Ej. https://facebook.com/pagina">

              <label for="admin-contacto-facebook-text">Texto de Facebook:</label>
              <input type="text" id="admin-contacto-facebook-text" placeholder="Ej. Tambo +">

              <label for="admin-contacto-tiktok-url">URL de TikTok:</label>
              <input type="text" id="admin-contacto-tiktok-url" placeholder="Ej. https://tiktok.com/@usuario">

              <label for="admin-contacto-tiktok-text">Texto de TikTok:</label>
              <input type="text" id="admin-contacto-tiktok-text" placeholder="Ej. tiendas_tambo">
            </div>


            <div class="boton-admin">
              <button id="limpiar-contacto" class="agregar-contacto">Limpiar </button>
              <button id="guardar-contacto" class="save">Guardar</button>
            </div>
          </div>
      </section>

      <!-- Categoría -->
      <section id="categoria">
        <div class="titulo-admin">
          <h1>CATEGORIAS</h1>
        </div>

        <div class="modificar-categoria">
          <h2 class="subtitulo">Modificar Categoría</h2>

          <label for="nombre-antiguo">Nombre actual:</label>
          <input type="text" id="nombre-antiguo" placeholder="Nombre actual de la categoría">

          <label for="nombre-nuevo">Nuevo nombre:</label>
          <input type="text" id="nombre-nuevo" placeholder="Nuevo nombre de la categoría">

          <div class="boton-admin">
            <button id="modificar-categoria" class="save">Guardar</button>
          </div>

        </div>

        <div class="editar-producto">
          <div class="crear-producto">
            <h2 class="subtitulo">Crear Producto</h2>

            <label for="categoria">Categoría:</label>
            <input type="text" id="producto-categoria" placeholder="Ej. Cervezas">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" placeholder="Ej. CERV001">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Ej. Cerveza Artesanal 330ml">

            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" placeholder="Ej. 15.90"><br>

            <label for="imagen">Imagen del producto:</label>
            <input type="file" id="imagen" accept="image/*">

            <div class="boton-admin">
              <button id="guardar-producto" class="save">Guardar</button>
              <button id="limpiar-formulario" class="delete">Eliminar</button>
            </div>
          </div>


        </div>

        <div class="producto-campo">

          <h2 class="subtitulo">Modificar Producto</h2>

          <h3 class="subsubtitulo">Buscar producto:</h3>
          <input type="text" id="buscar-codigo" placeholder="Código de producto">

          <div class="producto-campo">
            <h3 class="subsubtitulo">Nombre:</h3>
            <input type="text" id="modificar-nombre" placeholder="Nombre del producto">
          </div>

          <div class="producto-campo">
            <h3 class="subsubtitulo">Precio:</h3>
            <input type="number" id="modificar-precio" placeholder="Precio del producto">
          </div>

          <div class="producto-campo">
            <h3 class="subsubtitulo">Imagen:</h3>
            <input type="file" id="modificar-imagen">
          </div>

          <div class="boton-admin">
            <button id="eliminar-producto" class="borrar-producto">Borrar Producto</button>
            <button id="guardar-cambios-producto" class="save">Guardar</button>
          </div>

        </div>
    </div>
    </section>

  </div>
  </div>
  
</body>

</html>