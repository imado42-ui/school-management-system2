<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("
SELECT
    students.id,
    students.firstname,
    students.lastname,
    students.gender,
    students.phone,
    classes.class_name
FROM students
LEFT JOIN classes
ON students.class_id = classes.id
ORDER BY students.id DESC
");

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>قائمة التلاميذ</h2>

<p>
    <a href="add_student.php">➕ إضافة تلميذ</a>
</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">

<tr>
    <th>#</th>
    <th>الاسم</th>
    <th>اللقب</th>
    <th>الجنس</th>
    <th>القسم</th>
    <th>الهاتف</th>
    <th>الإجراءات</th>
</tr>

<?php foreach($students as $student): ?>

<tr>

<td><?= $student['id']; ?></td>

<td><?= htmlspecialchars($student['firstname']); ?></td>

<td><?= htmlspecialchars($student['lastname']); ?></td>

<td><?= htmlspecialchars($student['gender']); ?></td>

<td><?= htmlspecialchars($student['class_name']); ?></td>

<td><?= htmlspecialchars($student['phone']); ?></td>

<td>

<a href="edit_student.php?id=<?= $student['id']; ?>">✏️ تعديل</a>

|

<a href="delete_student.php?id=<?= $student['id']; ?>"
onclick="return confirm('هل تريد حذف هذا التلميذ؟');">

🗑 حذف

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>