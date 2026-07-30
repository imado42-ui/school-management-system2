<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (isset($_POST['save'])) {

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $semester   = $_POST['semester'];
    $mark       = $_POST['mark'];

    $stmt = $pdo->prepare("
        INSERT INTO marks
        (student_id, subject_id, semester, mark)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $student_id,
        $subject_id,
        $semester,
        $mark
    ]);

    header("Location: marks.php");
    exit;
}

$students = $pdo->query("
SELECT id, firstname, lastname
FROM students
ORDER BY firstname, lastname
")->fetchAll(PDO::FETCH_ASSOC);

$subjects = $pdo->query("
SELECT id, subject_name
FROM subjects
ORDER BY subject_name
")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>إضافة علامة</h2>

<form method="post">

<p>التلميذ</p>
<select name="student_id" required>
<?php foreach($students as $student): ?>
<option value="<?= $student['id']; ?>">
<?= htmlspecialchars($student['firstname'].' '.$student['lastname']); ?>
</option>
<?php endforeach; ?>
</select>

<p>المادة</p>
<select name="subject_id" required>
<?php foreach($subjects as $subject): ?>
<option value="<?= $subject['id']; ?>">
<?= htmlspecialchars($subject['subject_name']); ?>
</option>
<?php endforeach; ?>
</select>

<p>الفصل</p>
<select name="semester">
<option value="الفصل الأول">الفصل الأول</option>
<option value="الفصل الثاني">الفصل الثاني</option>
<option value="الفصل الثالث">الفصل الثالث</option>
</select>

<p>العلامة</p>
<input
type="number"
name="mark"
min="0"
max="20"
step="0.25"
required>

<br><br>

<button type="submit" name="save">
حفظ العلامة
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>