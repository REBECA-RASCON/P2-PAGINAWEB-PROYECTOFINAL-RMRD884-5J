<?php
// Abre la sesion del usuario
session_start();
// Si no inicio sesion, lo manda a la pagina de inicio de sesion
if (!isset($_SESSION["usuario_id"])) {
    header("Location: sesion.html");
    exit;
}
// Guarda el nombre del usuario de forma segura para mostrarlo
$nombre = htmlspecialchars($_SESSION["usuario_nombre"], ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Copalina</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <!-- Encabezado con el nombre del sitio -->
  <header>
    <h1>Copalina</h1>
  </header>

  <!-- Mensaje de bienvenida -->
  <main>
    <div class="tarjeta">
      <h2>Hola, <?= $nombre ?></h2>
      <div class="mensaje exito">Iniciaste sesion correctamente.</div>
      <p class="enlaces">
        <a href="index.html">Ir a la pagina principal</a><br>
        <a href="logout.php">Cerrar sesion</a>
      </p>
    </div>
  </main>

  <!-- Pie de pagina -->
  <footer>
    <p>REBECA MIRANDA RASCON DEVORA 5;J 0884</p>
  </footer>
</body>
</html>
