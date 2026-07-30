<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$search = "";

if(isset($_GET['search'])){
    $search = trim($_GET['search']);
}

$stmt = $pdo->prepare("
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

WHERE
students.firstname LIKE ?
OR students.lastname LIKE ?

ORDER BY students.lastname ASC
");

$stmt->execute([
"%$search%",
"%$search%"
]);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">إدارة التلاميذ</h2>

<form method="GET" class="mb-3">

<div class="input-group">

<input
type="text"
class="form-control"
name="search"
placeholder="ابحث باسم التلميذ..."
value="<?= htmlspecialchars($search) ?>">

<button class="btn btn-primary">
بحث
</button>

<a href="students.php"
class="btn btn-secondary">
إلغاء
</a>

</div>

</form>

<p>

<a href="add_student.php"
class="btn btn-success">

➕ إضافة تلميذ

</a>

</p>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>#</th>

<th>الاسم</th>

<th>اللقب</th>

<th>الجنس</th>

<th>القسم</th>

<th>الهاتف</th>

<th>الإجراءات</th>

</tr>

</thead>

<tbody>

<?php foreach($students as $student): ?>

<tr>

<td><?= $student['id']; ?></td>

<td><?= htmlspecialchars($student['firstname']); ?></td>

<td><?= htmlspecialchars($student['lastname']); ?></td>

<td><?= htmlspecialchars($student['gender']); ?></td>

<td><?= htmlspecialchars($student['class_name']); ?></td>

<td><?= htmlspecialchars($student['phone']); ?></td>

<td>

<a class="btn btn-warning btn-sm"
href="edit_student.php?id=<?= $student['id']; ?>">
تعديل
</a>

<a class="btn btn-danger btn-sm"
href="delete_student.php?id