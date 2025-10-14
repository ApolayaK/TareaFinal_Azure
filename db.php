<?php

$serverName = "apolayaserver.database.windows.net,1433"; 
$database = "atv"; 
$username = "apolayaadmin"; 
$password = "Apolaya123@@"; 

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("X ERROR: No se pudo conectar. Revisa tu Firewall de Azure y las credenciales. Detalle: " . $e->getMessage());
}
?>