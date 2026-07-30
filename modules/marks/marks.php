<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("
SELECT
    marks.id,
    students.firstname,
    students.lastname,
    subjects.subject_name,
    marks.semester,
    marks.mark
FROM marks
INNER JOIN students
    ON marks.student_id = students.id
INNER JOIN subjects
    ON marks.subject_id = subjects.id
ORDER BY marks.id DESC
");

$marks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>قائمة العلامات</h2>

<p>
    <a href="add_mark.php">➕ إضافة علامة</a>
</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">

<tr>
    <th>#</th>
    <th>التلميذ</th>
    <th>المادة</th>
    <th>الفصل</th>
    <th>العلامة</th>
    <th>الإجراءات</th>
</tr>

<?php foreach($marks as $row): ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= htmlspecialchars($row['firstname']." ".$row['lastname']); ?></td>

<td><?= htmlspecialchars($row['subject_name']); ?></td>

<td><?= htmlspecialchars($row['semester']); ?></td>

<td><?= $row['mark']; ?>/20</td>

<td>

<a href="edit_mark.php?id=<?= $row['id']; ?>">
✏️ تعديل
</a>

|

<a href="delete_mark.php?id=<?= $row['id']; ?>"
onclick="return confirm('هل تريد حذف هذه العلامة؟');">
🗑 حذف
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>