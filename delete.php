<?php
include 'db.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM periodistas WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: index.php");
exit();
?>