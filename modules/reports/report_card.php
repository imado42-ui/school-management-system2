<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['student_id'])) {
    die("لم يتم اختيار التلميذ.");
}

$student_id = (int)$_GET['student_id'];

$stmt = $pdo->prepare("
SELECT
    students.firstname,
    students.lastname,
    classes.class_name
FROM students
LEFT JOIN classes
ON students.class_id = classes.id
WHERE students.id = ?
");

$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("التلميذ غير موجود.");
}

$stmt = $pdo->prepare("
SELECT
    subjects.subject_name,
    subjects.coefficient,
    marks.mark,
    marks.semester
FROM marks
INNER JOIN subjects
ON marks.subject_id = subjects.id
WHERE marks.student_id = ?
ORDER BY subjects.subject_name
");

$stmt->execute([$student_id]);
$marks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
$totalCoef = 0;

foreach ($marks as $m) {
    $total += $m['mark'] * $m['coefficient'];
    $totalCoef += $m['coefficient'];
}

$average = ($totalCoef > 0) ? round($total / $totalCoef, 2) : 0;

if ($average >= 18)
    $mention = "ممتاز";
elseif ($average >= 16)
    $mention = "جيد جدًا";
elseif ($average >= 14)
    $mention = "جيد";
elseif ($average >= 12)
    $mention = "مستحسن";
elseif ($average >= 10)
    $mention = "مقبول";
else
    $mention = "راسب";
?>

<h2>كشف النقاط</h2>

<p><strong>التلميذ:</strong>
<?= htmlspecialchars($student['