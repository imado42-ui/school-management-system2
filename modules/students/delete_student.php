<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
$stmt->execute([$id]);

header("Location: students.php");
exit;