<?php
// Abre la sesion (aqui se guarda el carrito de cada visitante)
session_start();
require "conexion.php";
header("Content-Type: application/json; charset=utf-8");

// La primera letra del producto indica en que tabla esta (o1 -> ofertas, e1 -> electronica...)
$tablas = ["o" => "ofertas", "e" => "electronica", "z" => "zapatos", "m" => "motos"];

// Producto que mando el boton (ejemplo: "m8")
$producto = $_POST["producto"] ?? "";
$letra = substr($producto, 0, 1);

// Si la letra no esta en la lista, el producto no es valido
if (!isset($tablas[$letra])) {
    echo json_encode(["ok" => false, "mensaje" => "Producto no valido."]);
    exit;
}
$tabla = $tablas[$letra];

// Revisa que el producto exista en la base de datos
$consulta = $pdo->prepare("SELECT id FROM $tabla WHERE nombre = ?");
$consulta->execute([$producto]);
if (!$consulta->fetch()) {
    echo json_encode(["ok" => false, "mensaje" => "Ese producto no existe."]);
    exit;
}

// El carrito es un arreglo en la sesion: [nombre => cantidad]
// Si el producto ya estaba suma 1, si no empieza en 1
$_SESSION["carrito"][$producto] = ($_SESSION["carrito"][$producto] ?? 0) + 1;

echo json_encode(["ok" => true, "mensaje" => "Producto agregado al carrito."]);
