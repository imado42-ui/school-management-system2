<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";

if (!isset($_GET['id'])) {
    header("Location: subjects.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("DELETE FROM subjects WHERE id=?");
$stmt->execute([$id]);

header("Location: subjects.php");
exit;