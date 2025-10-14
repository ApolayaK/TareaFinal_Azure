<?php
include 'db.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no especificado.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE periodistas 
            SET nombre=?, apellido=?, medio=?, especialidad=?, email=?, telefono=? 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['medio'],
        $_POST['especialidad'],
        $_POST['email'],
        $_POST['telefono'],
        $_POST['id']
    ]);
    header("Location: index.php?action=updated");
    exit();
}

$sql = "SELECT TOP 1 id, nombre, apellido, medio, especialidad, email, telefono FROM periodistas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$periodista = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Periodista</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1><i class="fa-solid fa-pen-to-square"></i> Editar Registro</h1>
        <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</a>
    </header>

    <main class="container">
        <h3 class="text-center text-primary mb-4">Editar Información</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $periodista['id'] ?>">
            <div class="mb-3"><input class="form-control" type="text" name="nombre"
                    value="<?= htmlspecialchars($periodista['nombre']) ?>" required></div>
            <div class="mb-3"><input class="form-control" type="text" name="apellido"
                    value="<?= htmlspecialchars($periodista['apellido']) ?>" required></div>
            <div class="mb-3"><input class="form-control" type="text" name="medio"
                    value="<?= htmlspecialchars($periodista['medio']) ?>"></div>
            <div class="mb-3"><input class="form-control" type="text" name="especialidad"
                    value="<?= htmlspecialchars($periodista['especialidad']) ?>"></div>
            <div class="mb-3"><input class="form-control" type="email" name="email"
                    value="<?= htmlspecialchars($periodista['email']) ?>"></div>
            <div class="mb-3"><input class="form-control" type="text" name="telefono"
                    value="<?= htmlspecialchars($periodista['telefono']) ?>"></div>
            <button class="btn btn-primary w-100" type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar
                Cambios</button>
        </form>
    </main>

    <footer>© 2025 Redacción Digital — Edición de Datos</footer>
</body>

</html>