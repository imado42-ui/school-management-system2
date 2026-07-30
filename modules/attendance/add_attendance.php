<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $student_id = $_POST['student_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("
        INSERT INTO attendance
        (student_id, attendance_date, status)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $student_id,
        $attendance_date,
        $status
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

<h2>إضافة حضور</h2>

<form method="post">

<p>التلميذ</p>

<select name="student_id" class="form-control">

<?php foreach($students as $student): ?>

<option value="<?= $student['id']; ?>">

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
value="<?= date('Y-m-d'); ?>"
required>

<br>

<p>الحالة</p>

<select name="status" class="form-control">

<option value="حاضر">حاضر</option>

<option value="غائب">غائب</option>

<option value="متأخر">متأخر</option>

</select>

<br>

<button
type="submit"
name="save"
class="btn btn-success">

حفظ

</button>

</form>

<?php
require_once "../../includes/footer.php";
?>