<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$id = $_GET['id'];

if (isset($_POST['update'])) {

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $semester   = $_POST['semester'];
    $mark       = $_POST['mark'];

    $stmt = $pdo->prepare("
        UPDATE marks
        SET
            student_id=?,
            subject_id=?,
            semester=?,
            mark=?
        WHERE id=?
    ");

    $stmt->execute([
        $student_id,
        $subject_id,
        $semester,
        $mark,
        $id
    ]);

    header("Location: marks.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM marks WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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

<h2>تعديل العلامة</h2>

<form method="post">

<p>التلميذ</p>
<select name="student_id">

<?php foreach($students as $student): ?>

<option
value="<?= $student['id']; ?>"
<?= ($student['id']==$row['student_id']) ? "selected" : ""; ?>>

<?= htmlspecialchars($student['firstname']." ".$student['lastname']); ?>

</option>

<?php endforeach; ?>

</select>

<p>المادة</p>

<select name="subject_id">

<?php foreach($subjects as $subject): ?>

<option
value="<?= $subject['id']; ?>"
<?= ($subject['id']==$row['subject_id']) ? "selected" : ""; ?>>

<?= htmlspecialchars($subject['subject_name']); ?>

</option>

<?php endforeach; ?>

</select>

<p>الفصل</p>

<select name="semester">

<option value="الفصل الأول" <?= ($row['semester']=="الفصل الأول") ? "selected" : ""; ?>>
الفصل الأول
</option>

<option value="الفصل الثاني" <?= ($row['semester']=="الفصل الثاني") ? "selected" : ""; ?>>
الفصل الثاني
</option>

<option value="الفصل الثالث" <?= ($row['semester']=="الفصل الثالث") ? "selected" : ""; ?>>
الفصل الثالث
</option>

</select>

<p>العلامة</p>

<input
type="number"
name="mark"
min="0"
max="20"
step="0.25"
value="<?= $row['mark']; ?>"
required>

<br><br>

<button type="submit" name="update">
حفظ التعديل
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>