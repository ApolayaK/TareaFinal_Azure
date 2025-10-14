<?php
include 'db.php';
$id = $_GET['id'] ?? die('❌ ID no especificado.');

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
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT TOP 1 * FROM periodistas WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Periodista</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2><i class="fa-solid fa-pen-to-square"></i> Editar Periodista</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $p['id']; ?>">
            <input type="text" name="nombre" value="<?= htmlspecialchars($p['nombre']); ?>" required>
            <input type="text" name="apellido" value="<?= htmlspecialchars($p['apellido']); ?>" required>
            <input type="text" name="medio" value="<?= htmlspecialchars($p['medio']); ?>">
            <input type="text" name="especialidad" value="<?= htmlspecialchars($p['especialidad']); ?>">
            <input type="email" name="email" value="<?= htmlspecialchars($p['email']); ?>">
            <input type="text" name="telefono" value="<?= htmlspecialchars($p['telefono']); ?>">
            <button type="submit" class="btn"><i class="fa-solid fa-save"></i> Guardar cambios</button>
        </form>
        <a href="index.php" class="btn" style="margin-top:15px;"><i class="fa-solid fa-arrow-left"></i> Volver</a>
    </div>
</body>

</html>