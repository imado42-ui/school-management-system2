<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>قائمة التلاميذ</h2>

<p>
    <a href="add_student.php">➕ إضافة تلميذ جديد</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>#</th>
    <th>الاسم</th>
    <th>اللقب</th>
    <th>الجنس</th>
    <th>القسم</th>
    <th>الهاتف</th>
</tr>

<?php foreach($students as $student): ?>

<tr>
    <td><?= $student['id']; ?></td>
    <td><?= $student['firstname']; ?></td>
    <td><?= $student['lastname']; ?></td>
    <td><?= $student['gender']; ?></td>
    <td><?= $student['class']; ?></td>
    <td><?= $student['phone']; ?></td>
</tr>

<?php endforeach; ?>

</table>

<?php
require_once "../../includes/footer.php";
?>