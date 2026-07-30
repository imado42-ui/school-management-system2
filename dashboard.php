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

<h2 class="mb-4">لوحة التحكم</h2>

<div class="row">

<div class="col-md-4 mb-3">
<div class="card text-bg-primary">
<div class="card-body">
<h5>التلاميذ</h5>
<h2><?= $students ?></h2>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-bg-success">
<div class="card-body">
<h5>الأساتذة</h5>
<h2><?= $teachers ?></h2>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-bg-warning">
<div class="card-body">
<h5>الأقسام</h5>
<h2><?= $classes ?></h2>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-bg-info">
<div class="card-body">
<h5>المواد</h5>
<h2><?= $subjects ?></h2>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card text-bg-danger">
<div class="card-body">
<h5>العلامات</h5>
<h2><?= $marks ?></h2>
</div>
</div>
</div>

</div>

<hr>

<h3>الوصول السريع</h3>

<div class="list-group">

<a class="list-group-item list-group-item-action" href="modules/students/students.php">
👨‍🎓 إدارة التلاميذ
</a>

<a class="list-group-item list-group-item-action" href="modules/classes/classes.php">
🏫 إدارة الأقسام
</a>

<a class="list-group-item list-group-item-action" href="modules/teachers/teachers.php">
👨‍🏫 إدارة الأساتذة
</a>

<a class="list-group-item list-group-item-action" href="modules/subjects/subjects.php">
📚 إدارة المواد
</a>

<a class="list-group-item list-group-item-action" href="modules/marks/marks.php">
📝 إدارة العلامات
</a>

</div>

<?php
require_once "includes/footer.php";
?>