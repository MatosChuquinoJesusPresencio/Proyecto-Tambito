document.addEventListener("DOMContentLoaded", () => {
  fetch("routes/router.php?accion=obtener_datos_inicio")
    .then(res => res.json())
    .then(data => {

      const esloganEl = document.getElementById("hero-slogan");
      if (esloganEl && data.slogan) esloganEl.textContent = data.slogan;

      if (Array.isArray(data.categorias)) {
        data.categorias.forEach((cat, i) => {
          const span = document.getElementById(`categoria${i + 1}-span`);
          const img = document.getElementById(`categoria${i + 1}-img`);

          if (span) span.textContent = cat.titulo;
          if (img) img.src = cat.imagen_url + "?v=" + Date.now();
        });
      }
    })
    .catch(err => {
      console.error("❌ Error al cargar inicio:", err);
    });
});