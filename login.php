<?php
// Inicia la sesion del usuario
session_start();
header("Content-Type: application/json; charset=utf-8");
// Trae la conexion a la base de datos
require "conexion.php";

// Envia la respuesta al navegador en formato JSON
function responder($ok, $mensaje) {
    echo json_encode(["ok" => $ok, "mensaje" => $mensaje]);
    exit;
}

// Solo acepta datos enviados por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    responder(false, "Metodo no permitido.");
}

// Toma lo que escribio el usuario
$email    = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Revisa que no haya campos vacios
if ($email === "" || $password === "") {
    responder(false, "Escribe tu email y tu contrasena.");
}

// Busca al usuario por su email
$stmt = $pdo->prepare("SELECT id, nombre, password_hash FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Si el email no existe, avisa
if (!$usuario) {
    responder(false, "No existe una cuenta con ese email.");
}
// Compara la contrasena con la guardada
if (!password_verify($password, $usuario["password_hash"])) {
    responder(false, "Contrasena incorrecta. Intentalo de nuevo.");
}

// Cambia el id de sesion por seguridad
session_regenerate_id(true);
// Guarda los datos del usuario en la sesion
$_SESSION["usuario_id"]     = $usuario["id"];
$_SESSION["usuario_nombre"] = $usuario["nombre"];

// Todo salio bien
responder(true, "Bienvenido.");
