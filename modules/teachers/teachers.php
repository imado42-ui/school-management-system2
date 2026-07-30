<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("SELECT * FROM teachers ORDER BY id DESC");
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>إدارة الأساتذة</h2>

<p>
    <a href="add_teacher.php">➕ إضافة أستاذ</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>#</th>
    <th>الاسم الكامل</th>
    <th>التخصص</th>
    <th>الهاتف</th>
    <th>البريد الإلكتروني</th>
    <th>الإجراءات</th>
</tr>

<?php foreach($teachers as $teacher): ?>

<tr>

<td><?= $teacher['id']; ?></td>

<td><?= $teacher['full_name']; ?></td>

<td><?= $teacher['specialty']; ?></td>

<td><?= $teacher['phone']; ?></td>

<td><?= $teacher['email']; ?></td>

<td>
<a href="edit_teacher.php?id=<?= $teacher['id']; ?>">✏️ تعديل</a>
|
<a href="delete_teacher.php?id=<?= $teacher['id']; ?>"
onclick="return confirm('هل تريد حذف الأستاذ؟');">
🗑 حذف
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>