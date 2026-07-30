<?php
require_once "config/database.php";
require_once "includes/auth.php";
require_once "includes/header.php";

$students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$teachers = $pdo->query("SELECT COUNT(*) FROM teachers")->fetchColumn();
$classes  = $pdo->query("SELECT COUNT(*) FROM classes")->fetchColumn();
$subjects = $pdo->query("SELECT COUNT(*) FROM subjects")->fetchColumn();
$marks    = $pdo->query("SELECT COUNT(*) FROM marks")->fetchColumn();
?>

<h1>لوحة التحكم</h1>

<table border="1" cellpadding="15" cellspacing="0" width="100%">

<tr>

<td align="center">
<h2><?= $students ?></h2>
عدد التلاميذ
</td>

<td align="center">
<h2><?= $teachers ?></h2>
عدد الأساتذة
</td>

<td align="center">
<h2><?= $classes ?></h2>
عدد الأقسام
</td>

</tr>

<tr>

<td align="center">
<h2><?= $subjects ?></h2>
عدد المواد
</td>

<td align="center">
<h2><?= $marks ?></h2>
عدد العلامات
</td>

<td align="center">
<h2><?= date("Y") ?></h2>
السنة الدراسية
</td>

</tr>

</table>

<br><br>

<h2>القائمة السريعة</h2>

<ul>

<li><a href="modules/students/students.php">👨‍🎓 إدارة التلاميذ</a></li>

<li><a href="modules/classes/classes.php">🏫 إدارة الأقسام</a></li>

<li><a href="modules/teachers/teachers.php">👨‍🏫 إدارة الأساتذة</a></li>

<li><a href="modules/subjects/subjects.php">📚 إدارة المواد</a></li>

<li><a href="modules/marks/marks.php">📝 إدارة العلامات</a></li>

</ul>

<?php
require_once "includes/footer.php";
?>