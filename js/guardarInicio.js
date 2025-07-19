document.addEventListener("DOMContentLoaded", () => {
  const btnEslogan = document.getElementById("guardar-eslogan");
  const btnCategorias = document.getElementById("guardar-categorias-home");

  if (btnEslogan) {
    btnEslogan.addEventListener("click", async () => {
      const texto = document.getElementById("admin-eslogan").value.trim();
      const formData = new FormData();
      formData.append("clave", "slogan");
      formData.append("valor", texto);

      const res = await fetch("routes/router.php?accion=guardar_config", {
        method: "POST",
        body: formData
      });
      const data = await res.json();
      alert(data.mensaje || "Eslogan actualizado");
    });
  }

  if (btnCategorias) {
    btnCategorias.addEventListener("click", async () => {
      const formData = new FormData();
      for (let i = 1; i <= 5; i++) {
        const nombre = document.getElementById(`admin-categoria-${i}-nombre`).value.trim();
        const imagen = document.getElementById(`admin-categoria-${i}-imagen`).files[0];
        const actual = document.getElementById(`admin-categoria-${i}-imagen-actual`).value;

        formData.append(`categoria_${i}_nombre`, nombre);
        formData.append(`categoria_${i}_orden`, i);
        if (imagen) {
          formData.append(`categoria_${i}_imagen`, imagen);
        } else {
          formData.append(`categoria_${i}_imagen_actual`, actual);
        }
      }

      const res = await fetch("routes/router.php?accion=guardar_secciones_inicio", {
        method: "POST",
        body: formData
      });
      const data = await res.json();
      alert(data.mensaje || "Categorías actualizadas");
    });
  }
});