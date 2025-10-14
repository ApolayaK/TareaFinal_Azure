<?php
$serverName = "localhost";
$database = "tu_base_de_datos";
$username = "tu_usuario";
$password = "tu_contraseña";

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Conexión fallida: " . $e->getMessage());
}
?>