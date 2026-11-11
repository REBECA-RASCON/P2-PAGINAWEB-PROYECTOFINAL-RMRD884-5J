<?php
// Abre la sesion (aqui esta guardado el carrito)
session_start();
require "conexion.php";

// La primera letra del producto indica en que tabla esta
$tablas = ["o" => "ofertas", "e" => "electronica", "z" => "zapatos", "m" => "motos"];

// Carrito actual: [nombre => cantidad]
$carrito = $_SESSION["carrito"] ?? [];
$mensaje = "";
$clase = "";

// Boton que se presiono (si es que se presiono alguno)
$accion = $_POST["accion"] ?? "";

// ---------- VACIAR CARRITO ----------
if ($accion === "vaciar") {
    $_SESSION["carrito"] = [];
    $carrito = [];
}

// ---------- COMPRAR (resta el stock en la base de datos) ----------
if ($accion === "comprar" && $carrito) {
    // La transaccion hace que se guarde todo o nada
    $pdo->beginTransaction();
    try {
        foreach ($carrito as $nombre => $cantidad) {
            $tabla = $tablas[substr($nombre, 0, 1)];
            // Resta solo si hay suficiente stock
            $resta = $pdo->prepare("UPDATE $tabla SET stock = stock - ? WHERE nombre = ? AND stock >= ?");
            $resta->execute([$cantidad, $nombre, $cantidad]);
            // Si no se modifico ninguna fila, no alcanzo el stock
            if ($resta->rowCount() === 0) {
                throw new Exception("No hay suficiente stock de $nombre.");
            }
        }
        $pdo->commit();
        $_SESSION["carrito"] = [];
        $carrito = [];
        $mensaje = "Compra realizada. Gracias!";
        $clase = "exito";
    } catch (Exception $e) {
        $pdo->rollBack();
        $mensaje = $e->getMessage();
        $clase = "error";
    }
}

// ---------- LEE LOS PRECIOS DE LA BASE DE DATOS ----------
$filas = [];
$total = 0;
foreach ($carrito as $nombre => $cantidad) {
    $tabla = $tablas[substr($nombre, 0, 1)];
    $consulta = $pdo->prepare("SELECT precio FROM $tabla WHERE nombre = ?");
    $consulta->execute([$nombre]);
    $precio = $consulta->fetchColumn();

    $subtotal = $precio * $cantidad;
    $total += $subtotal;
    $filas[] = ["nombre" => $nombre, "precio" => $precio, "cantidad" => $cantidad, "subtotal" => $subtotal];
}
?>
<!DOCTYPE html>
<html lang="es">
<!-- Datos de la pagina -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Copalina</title>
  <link rel="stylesheet" href="estilos.css">
</head>

<!-- Contenido visible -->
<body>
  <!-- Aviso de envio gratis -->
  <div class="aviso">
    <h3>ESTRENA Y APROVECHA ENVIO GRATIS A PARTIR DE $599</h3>
  </div>

  <!-- Encabezado con el nombre del sitio -->
  <header>
    <h1>Carrito</h1>
  </header>

  <!-- Menu de navegacion -->
  <nav>
    <a href="ofertas.html">Ofertas</a>
    <a href="zapatos.html">Zapatos</a>
    <a href="elec.html">Electronica</a>
    <a href="motos.html">Motos y Mobilidad</a>
    <a href="carrito.php">🛒 Carrito</a>
    <a href="sesion.html">Iniciar sesion</a>
    <a href="registro.html">Registrar</a>
    <a href="index.html">Inicio</a>
  </nav>

  <main>
    <!-- Mensaje de compra o de error -->
    <?php if ($mensaje): ?>
      <div class="mensaje <?= $clase ?>"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <?php if (empty($filas)): ?>
      <p>Tu carrito esta vacio.</p>
    <?php else: ?>
      <!-- Tabla con los productos del carrito -->
      <table>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
        <?php foreach ($filas as $f): ?>
          <tr>
            <td><img src="<?= $f['nombre'] ?>.png" alt="<?= $f['nombre'] ?>" width="60"><br><?= $f['nombre'] ?></td>
            <td>$<?= number_format($f["precio"], 2) ?></td>
            <td><?= $f["cantidad"] ?></td>
            <td>$<?= number_format($f["subtotal"], 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

      <h2 style="text-align:center">Total: $<?= number_format($total, 2) ?></h2>

      <!-- Los dos botones mandan su valor en "accion" -->
      <form method="post">
        <div class="botones">
          <button class="btn" type="submit" name="accion" value="comprar">Comprar</button>
          <button class="btn" type="submit" name="accion" value="vaciar">Vaciar carrito</button>
        </div>
      </form>
    <?php endif; ?>
  </main>

  <!-- Pie de pagina -->
  <footer>
    <p>no cambiar este texto porfavor</p>
  </footer>
</body>
</html>
