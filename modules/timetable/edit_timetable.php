<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: timetable.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM timetable WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("الحصة غير موجودة");
}

if (isset($_POST['update'])) {

    $class_id    = $_POST['class_id'];
    $subject_id  = $_POST['subject_id'];
    $teacher_id  = $_POST['teacher_id'];
    $day         = $_POST['day_of_week'];
    $time        = trim($_POST['lesson_time']);

    $stmt = $pdo->prepare("
        UPDATE timetable
        SET
            class_id=?,
            subject_id=?,
            teacher_id=?,
            day_of_week=?,
            lesson_time=?
        WHERE id=?
    ");

    $stmt->execute([
        $class_id,
        $subject_id,
        $teacher_id,
        $day,
        $time