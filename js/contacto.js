document.addEventListener("DOMContentLoaded", () => {
  fetch("routes/router.php?accion=listar_contacto")
    .then(res => res.json())
    .then(data => {
      const info = data.info;
      const redes = data.redes;
  
      if (info) {
        document.getElementById("contacto-horario").textContent = info.horario_atencion;
        document.getElementById("contacto-telefono").textContent = info.telefono;
        document.getElementById("contacto-email").textContent = info.email;
      }

      redes.forEach(red => {
        const nombre = red.nombre.toLowerCase(); 

        const linkEl = document.getElementById(`contacto-${nombre}-link`);
        const textEl = document.getElementById(`contacto-${nombre}-text`);

        if (linkEl) linkEl.href = red.url;
        if (textEl) textEl.textContent = red.texto_visible;
      });
    })
    .catch(err => {
      console.error("⛔ Error al cargar contacto:", err);
    });
});