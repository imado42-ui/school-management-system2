<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("
SELECT
attendance.id,
students.firstname,
students.lastname,
attendance.attendance_date,
attendance.status
FROM attendance
INNER JOIN students
ON attendance.student_id = students.id
ORDER BY attendance.attendance_date DESC
");

$attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>سجل الحضور والغياب</h2>

<p>
<a href="add_attendance.php" class="btn btn-success">
➕ إضافة حضور
</a>
</p>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>#</th>
<th>التلميذ</th>
<th>التاريخ</th>
<th>الحالة</th>
<th>الإجراءات</th>

</tr>

</thead>

<tbody>

<?php foreach($attendance as $row): ?>

<tr>

<td><?= $row['id']; ?></td>

<td>
<?= htmlspecialchars($row['firstname']." ".$row['lastname']); ?>
</td>

<td><?= htmlspecialchars($row['attendance_date']); ?></td>

<td><?= htmlspecialchars($row['status']); ?></td>

<td>

<a
href="edit_attendance.php?id=<?= $row['id']; ?>"
class="btn btn-warning btn-sm">

تعديل

</a>

<a
href="delete_attendance.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('هل تريد حذف هذا السجل؟');">

حذف

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?php
require_once "../../includes/footer.php";
?>