// Busca todos los botones "Comprar" de la pagina
const botones = document.querySelectorAll(".comprar");

// A cada boton le dice que hacer cuando se le da clic
botones.forEach(function (boton) {
  boton.addEventListener("click", function () {
    // Lee el nombre del producto del atributo data-producto (ejemplo: "m8")
    const producto = boton.dataset.producto;

    // Prepara los datos que se van a mandar al servidor
    const datos = new FormData();
    datos.append("producto", producto);

    // Manda el producto a agregar.php y muestra la respuesta
    fetch("agregar.php", { method: "POST", body: datos })
      .then(function (respuesta) { return respuesta.json(); })
      .then(function (resultado) { alert(resultado.mensaje); });
  });
});
