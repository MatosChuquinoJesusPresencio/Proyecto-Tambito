document.addEventListener("DOMContentLoaded", () => {
  const guardarBtn = document.getElementById("guardar-contacto");
  if (!guardarBtn) return;

  guardarBtn.addEventListener("click", async (e) => {
    e.preventDefault();
 
    const formData = new FormData();
    formData.append("horario_atencion", document.getElementById("admin-contacto-horario").value);
    formData.append("telefono", document.getElementById("admin-contacto-telefono").value);
    formData.append("email", document.getElementById("admin-contacto-email").value);

    formData.append("instagram_url", document.getElementById("admin-contacto-instagram-url").value);
    formData.append("instagram_text", document.getElementById("admin-contacto-instagram-text").value);

    formData.append("facebook_url", document.getElementById("admin-contacto-facebook-url").value);
    formData.append("facebook_text", document.getElementById("admin-contacto-facebook-text").value);

    formData.append("tiktok_url", document.getElementById("admin-contacto-tiktok-url").value);
    formData.append("tiktok_text", document.getElementById("admin-contacto-tiktok-text").value);

    for (const pair of formData.entries()) {
      console.log(`${pair[0]}: ${pair[1]}`);
    }

    try {
      const res = await fetch("routes/router.php?accion=guardar_contacto", {
        method: "POST",
        body: formData
      });
      const data = await res.json();
      alert(data.mensaje || "Guardado correctamente.");
    } catch (err) {
      console.error("Error al guardar contacto:", err);
      alert("Hubo un problema al guardar.");
    }
  });
});