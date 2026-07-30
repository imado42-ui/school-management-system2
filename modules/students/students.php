<?php
session_start();
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";
require_once "../../includes/sidebar.php";
?>

<div style="margin-left:270px;padding:20px;">

<h2>إدارة التلاميذ</h2>

<p>
    <a href="add_student.php">➕ إضافة تلميذ جديد</a>
</p>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>رقم</th>
        <th>الاسم</th>
        <th>اللقب</th>
        <th>القسم</th>
        <th>العمليات</th>
    </tr>

<?php

$stmt = $pdo->query("SELECT * FROM students");

while($row = $stmt->fetch()){

    echo "<tr>";
    echo "<td>".$row['registration_number']."</td>";
    echo "<td>".$row['first_name']."</td>";
    echo "<td>".$row['last_name']."</td>";
    echo "<td>".$row['class_id']."</td>";
    echo "<td>تعديل | حذف</td>";
    echo "</tr>";

}

?>

</table>

</div>

<?php
require_once "../../includes/footer.php";
?>