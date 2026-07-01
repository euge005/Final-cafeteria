document.addEventListener("DOMContentLoaded", function () {
    const inputNombre = document.getElementById("nom_comida");

    // 1. Bloquear números mientras escribe
    inputNombre.addEventListener("keypress", function (e) {
        // Expresión regular: solo letras, espacios y acentos
        const filtro = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        
        // Si la tecla presionada no coincide con el filtro, cancelamos el evento
        if (!filtro.test(e.key)) {
            e.preventDefault();
        }
    });

    // 2. Limpiar números si el usuario copia y pega
    inputNombre.addEventListener("input", function () {
        // Reemplaza cualquier dígito (\d) por nada ""
        this.value = this.value.replace(/\d/g, "");
    });
});