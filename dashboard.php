<?php
include "includes/auth.php";
include "includes/header.php";
?>

<h2>لوحة التحكم</h2>

<ul>
    <li><a href="modules/students/students.php">إدارة الطلاب</a></li>
    <li><a href="modules/teachers/teachers.php">إدارة الأساتذة</a></li>
    <li><a href="modules/classes/classes.php">إدارة الأقسام</a></li>
    <li><a href="modules/subjects/subjects.php">إدارة المواد</a></li>
    <li><a href="modules/attendance/attendance.php">إدارة الحضور</a></li>
    <li><a href="modules/grades/grades.php">إدارة النقاط</a></li>
    <li><a href="modules/exams/exams.php">إدارة الامتحانات</a></li>
    <li><a href="modules/reports/reports.php">التقارير</a></li>
    <li><a href="modules/users/users.php">إدارة المستخدمين</a></li>
</ul>

<?php
include "includes/footer.php";
?>