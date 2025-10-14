<?php
include 'db.php';
$stmt = $conn->query("SELECT id, nombre, apellido, medio, especialidad, email, telefono FROM periodistas ORDER BY id DESC");
$periodistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Periodistas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2><i class="fa-solid fa-newspaper"></i> Panel de Periodistas</h2>

        <a href="create.php" class="btn"><i class="fa-solid fa-user-plus"></i> Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Medio</th>
                    <th>Especialidad</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($periodistas as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']); ?></td>
                        <td><?= htmlspecialchars($p['medio']); ?></td>
                        <td><?= htmlspecialchars($p['especialidad']); ?></td>
                        <td><?= htmlspecialchars($p['email']); ?></td>
                        <td><?= htmlspecialchars($p['telefono']); ?></td>
                        <td>
                            <a href="edit.php?id=<?= $p['id']; ?>" class="icon-action" title="Editar"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?id=<?= $p['id']; ?>" class="icon-action" title="Eliminar"
                                onclick="return confirm('¿Seguro que deseas eliminar este registro?');"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <footer>© 2025 Ishume Productora - Área de Comunicaciones</footer>
    </div>
</body>

</html>