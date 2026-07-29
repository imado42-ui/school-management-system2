<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";
?>

<div class="container">

<h2>إدارة التلاميذ</h2>

<p>مرحبًا بك في قسم إدارة التلاميذ.</p>

<a href="add_student.php">
    <button>➕ إضافة تلميذ</button>
</a>

<br><br>

<table border="1" width="100%" cellspacing="0" cellpadding="10">

<tr style="background:#0d6efd;color:white;">
<th>الرقم</th>
<th>الاسم</th>
<th>اللقب</th>
<th>القسم</th>
<th>الإجراءات</th>
</tr>

<?php

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

echo "<tr>";

echo "<td>".$row['id']."</td>";

echo "<td>".$row['first_name']."</td>";

echo "<td>".$row['last_name']."</td>";

echo "<td>".$row['class_name']."</td>";

echo "<td>

<a href='edit_student.php?id=".$row['id']."'>تعديل</a>

|

<a href='delete_student.php?id=".$row['id']."'>حذف</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>

<?php
require_once "../../includes/footer.php";
?>