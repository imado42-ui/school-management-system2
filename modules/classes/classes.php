<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("SELECT * FROM classes ORDER BY id DESC");
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>إدارة الأقسام</h2>

<p>
    <a href="add_class.php">➕ إضافة قسم جديد</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>#</th>
    <th>اسم القسم</th>
    <th>المستوى</th>
    <th>الإجراءات</th>
</tr>

<?php foreach($classes as $class): ?>

<tr>

<td><?= $class['id']; ?></td>

<td><?= $class['class_name']; ?></td>

<td><?= $class['level']; ?></td>

<td>
<a href="edit_class.php?id=<?= $class['id']; ?>">✏️ تعديل</a>
|
<a href="delete_class.php?id=<?= $class['id']; ?>"
onclick="return confirm('هل تريد حذف القسم؟');">
🗑 حذف
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>