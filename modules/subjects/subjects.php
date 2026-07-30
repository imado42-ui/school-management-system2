<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("SELECT * FROM subjects ORDER BY id DESC");
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>إدارة المواد الدراسية</h2>

<p>
    <a href="add_subject.php">➕ إضافة مادة</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>#</th>
    <th>اسم المادة</th>
    <th>المعامل</th>
    <th>الإجراءات</th>
</tr>

<?php foreach($subjects as $subject): ?>

<tr>

<td><?= $subject['id']; ?></td>

<td><?= $subject['subject_name']; ?></td>

<td><?= $subject['coefficient']; ?></td>

<td>
<a href="edit_subject.php?id=<?= $subject['id']; ?>">✏️ تعديل</a>
|
<a href="delete_subject.php?id=<?= $subject['id']; ?>"
onclick="return confirm('هل تريد حذف المادة؟');">
🗑 حذف
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>