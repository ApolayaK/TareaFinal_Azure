<?php
include 'db.php';
$id = $_GET['id'] ?? die('❌ ID no especificado.');

$stmt = $conn->prepare("DELETE FROM periodistas WHERE id=?");
$stmt->execute([$id]);
header("Location: index.php");
exit();
?>