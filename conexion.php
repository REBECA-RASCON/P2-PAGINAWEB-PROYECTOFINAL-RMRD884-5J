<?php
// Datos de conexion. Cambia usuario y contrasena segun tu servidor.
// NO subas este archivo con tus datos reales a GitHub.
// Servidor de la base de datos
$host = "localhost";
$bd   = "copalina";
$user = "root";
$pass = "";

// Intenta conectarse a MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pass);
    // Muestra errores si algo falla
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Si no se pudo conectar, avisa y se detiene
} catch (PDOException $e) {
    header("Content-Type: application/json; charset=utf-8");
    http_response_code(500);
    echo json_encode(["ok" => false, "mensaje" => "Error al conectar con la base de datos."]);
    exit;
}
