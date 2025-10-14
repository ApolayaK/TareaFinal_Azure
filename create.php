<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO periodistas (nombre, apellido, medio, especialidad, email, telefono)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['medio'],
        $_POST['especialidad'],
        $_POST['email'],
        $_POST['telefono']
    ]);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Periodista</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1><i class="fa-solid fa-newspaper"></i> Sistema de Gestión</h1>
        <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</a>
    </header>

    <main class="container">
        <h3 class="text-center text-primary mb-4"><i class="fa-solid fa-user-plus"></i> Nuevo Periodista</h3>
        <form method="POST">
            <div class="mb-3"><input class="form-control" type="text" name="nombre" placeholder="Nombre" required></div>
            <div class="mb-3"><input class="form-control" type="text" name="apellido" placeholder="Apellido" required>
            </div>
            <div class="mb-3"><input class="form-control" type="text" name="medio" placeholder="Medio de Comunicación">
            </div>
            <div class="mb-3"><input class="form-control" type="text" name="especialidad" placeholder="Especialidad">
            </div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="mb-3"><input class="form-control" type="text" name="telefono" placeholder="Teléfono"></div>
            <button class="btn btn-primary w-100" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </main>

    <footer>© 2025 Redacción Digital — Módulo de Registro</footer>
</body>

</html>