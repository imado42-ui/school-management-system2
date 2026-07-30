<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM attendance WHERE id=?");
$stmt->execute([$id]);
$attendance = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$attendance){
    die("سجل الحضور غير موجود");
}

if(isset($_POST['update'])){

    $student_id = $_POST['student_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("
        UPDATE attendance
        SET
            student_id=?,
            attendance_date=?,
            status=?
        WHERE id=?
    ");

    $stmt->execute([
        $student_id,
        $attendance_date,
        $status,
        $id
    ]);

    header("Location: attendance.php");
    exit;
}

$students = $pdo->query("
SELECT id, firstname, lastname
FROM students
ORDER BY firstname, lastname
")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>تعديل الحضور</h2>

<form method="post">

<p>التلميذ</p>

<select name="student_id" class="form-control">

<?php foreach($students as $student): ?>

<option
value="<?= $student['id']; ?>"
<?= ($student['id']==$attendance['student_id']) ? "selected" : ""; ?>>

<?= htmlspecialchars($student['firstname']." ".$student['lastname']); ?>

</option>

<?php endforeach; ?>

</select>

<br>

<p>التاريخ</p>

<input
type="date"
name="attendance_date"
class="form-control"
value="<?= $attendance['attendance_date']; ?>"
required>

<br>

<p>الحالة</p>

<select name="status" class="form-control">

<option value="حاضر" <?= ($attendance['status']=="حاضر") ? "selected" : ""; ?>>حاضر</option>

<option value="غائب" <?= ($attendance['status']=="غائب") ? "selected" : ""; ?>>غائب</option>

<option value="متأخر" <?= ($attendance['status']=="متأخر") ? "selected" : ""; ?>>متأخر</option>

</select>

<br>

<button
type="submit"
name="update"
class="btn btn-primary">

حفظ التعديلات

</button>

</form>

<?php
require_once "../../includes/footer.php";
?>