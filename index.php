<?php
include 'db.php';
$stmt = $conn->query("SELECT id, nombre, apellido, medio, especialidad FROM periodistas ORDER BY apellido ASC");
$periodistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Periodistas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h1><i class="fa-solid fa-newspaper"></i> Sistema de Gestión de Periodistas</h1>
        <a href="create.php" class="btn btn-warning"><i class="fa-solid fa-user-plus"></i> Nuevo</a>
    </header>

    <main class="container">
        <h3 class="text-center text-primary mb-4">Listado General</h3>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Medio</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($periodistas as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?></td>
                        <td><?= htmlspecialchars($p['medio']) ?></td>
                        <td><?= htmlspecialchars($p['especialidad']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>
                            <a href="delete.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Eliminar al periodista <?= htmlspecialchars($p['nombre']) ?>?');">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>© 2025 Redacción Digital — Plataforma de Gestión Interna</footer>
</body>

</html>