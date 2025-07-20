document.addEventListener("DOMContentLoaded", () => {
  const btnEslogan = document.getElementById("guardar-eslogan");
  const btnCategorias = document.getElementById("guardar-categorias-home");

  if (btnEslogan) {
    btnEslogan.addEventListener("click", async () => {
      const texto = document.getElementById("admin-eslogan").value.trim();
      const formData = new FormData();
      formData.append("clave", "slogan");
      formData.append("valor", texto);

      try {
        const res = await fetch("routes/router.php?accion=guardar_config", {
          method: "POST",
          body: formData
        });

        const text = await res.text();
        console.log("Respuesta cruda:", text);
        const data = JSON.parse(text);
        alert(data.mensaje || "Eslogan guardado");
      } catch (err) {
        console.error("Error en la petición para guardar eslogan:", err);
      }
    });
  }

  if (btnCategorias) {
    btnCategorias.addEventListener("click", async () => {
      const formData = new FormData();

      for (let i = 1; i <= 5; i++) {
        const nombre = document.getElementById(`categoria${i}-nombre`).value.trim().toLowerCase();
        const imagen = document.getElementById(`categoria${i}-imagen`).files[0];
        const actual = document.getElementById(`categoria${i}-imagen-actual`).value;

        formData.append(`cat_${i}_titulo`, nombre);
        formData.append(`cat_${i}_orden`, i);

        if (imagen) {
          formData.append(`cat_${i}_imagen`, imagen);
        } else {
          formData.append(`cat_${i}_imagen_actual`, actual);
        }
      }

      formData.append("total", 5);
 
      try {
        const res = await fetch("routes/router.php?accion=guardar_secciones_inicio", {
          method: "POST",
          body: formData
        });
        const data = await res.json();
        alert(data.mensaje || "Categorías actualizadas");
      } catch (err) {
        console.error("❌ Error guardando categorías:", err);
      }
    });
  }
});