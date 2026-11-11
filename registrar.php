<?php
// Responde en formato JSON
header("Content-Type: application/json; charset=utf-8");
// Trae la conexion a la base de datos
require "conexion.php";

// Envia la respuesta al navegador
function responder($ok, $mensaje) {
    echo json_encode(["ok" => $ok, "mensaje" => $mensaje]);
    exit;
}

// Solo acepta datos enviados por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    responder(false, "Metodo no permitido.");
}

// Toma los datos del formulario
$email     = trim($_POST["email"] ?? "");
$nombre    = trim($_POST["nombre"] ?? "");
$apellido  = trim($_POST["apellido"] ?? "");
$password  = $_POST["password"] ?? "";
$password2 = $_POST["password2"] ?? "";

// Revisa que no haya campos vacios
if ($email === "" || $nombre === "" || $apellido === "" || $password === "") {
    responder(false, "Llena todos los campos.");
}
// Revisa que el email sea valido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    responder(false, "El email no es valido.");
}
// La contrasena debe tener minimo 8 caracteres
if (strlen($password) < 8) {
    responder(false, "La contrasena debe tener al menos 8 caracteres.");
}
// Las dos contrasenas deben ser iguales
if ($password !== $password2) {
    responder(false, "Las contrasenas no coinciden.");
}

// Revisar si el email ya existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    responder(false, "Ese email ya esta registrado. Intenta iniciar sesion.");
}

// Guardar con la contrasena cifrada (nunca en texto plano)
// Cifra la contrasena
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare(
    "INSERT INTO usuarios (email, nombre, apellido, password_hash) VALUES (?, ?, ?, ?)"
);
// Guarda al usuario en la base de datos
$stmt->execute([$email, $nombre, $apellido, $hash]);

// Cuenta creada con exito
responder(true, "Cuenta creada.");
