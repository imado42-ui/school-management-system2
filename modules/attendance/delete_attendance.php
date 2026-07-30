<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";

if (!isset($_GET['id'])) {
    header("Location: attendance.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("DELETE FROM attendance WHERE id = ?");
$stmt->execute([$id]);

header("Location: attendance.php");
exit;