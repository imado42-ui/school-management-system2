<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("
SELECT
timetable.id,
classes.class_name,
subjects.subject_name,
teachers.full_name,
timetable.day_of_week,
timetable.lesson_time

FROM timetable

INNER JOIN classes
ON timetable.class_id=classes.id

INNER JOIN subjects
ON timetable.subject_id=subjects.id

INNER JOIN teachers
ON timetable.teacher_id=teachers.id

ORDER BY
FIELD(day_of_week,
'الأحد',
'الإثنين',
'الثلاثاء',
'الأربعاء',
'الخميس'),
lesson_time
");

$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">الجدول الزمني</h2>

<a href="add_timetable.php"
class="btn btn-success mb-3">
➕ إضافة حصة
</a>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>#</th>

<th>القسم</th>

<th>المادة</th>

<th>الأستاذ</th>

<th>اليوم</th>

<th>التوقيت</th>

<th>الإجراءات</th>

</tr>

</thead>

<tbody>

<?php foreach($rows as $row): ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= htmlspecialchars($row['class_name']) ?></td>

<td><?= htmlspecialchars($row['subject_name']) ?></td>

<td><?= htmlspecialchars($row['full_name']) ?></td>

<td><?= htmlspecialchars($row['day_of_week']) ?></td>

<td><?= htmlspecialchars($row['lesson_time']) ?></td>

<td>

<a
class="btn btn-warning btn-sm"
href="edit_timetable.php?id=<?= $row['id'] ?>">
تعديل
</a>

<a
class="btn btn-danger btn-sm"
href="delete_timetable.php?id=<?= $row['id'] ?>"
onclick="return confirm('حذف هذه الحصة؟')">
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