<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO periodistas (nombre, apellido, medio, especialidad, email, telefono)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (
        $stmt->execute([
            $_POST['nombre'],
            $_POST['apellido'],
            $_POST['medio'],
            $_POST['especialidad'],
            $_POST['email'],
            $_POST['telefono']
        ])
    ) {
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Error al crear registro.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Periodista</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2><i class="fa-solid fa-user-plus"></i> Nuevo Periodista</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="text" name="medio" placeholder="Medio">
            <input type="text" name="especialidad" placeholder="Especialidad">
            <input type="email" name="email" placeholder="Correo">
            <input type="text" name="telefono" placeholder="Teléfono">
            <button type="submit" class="btn"><i class="fa-solid fa-save"></i> Guardar</button>
        </form>
        <a href="index.php" class="btn" style="margin-top:15px;"><i class="fa-solid fa-arrow-left"></i> Volver</a>
    </div>
</body>

</html>