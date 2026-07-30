<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>
</head>

<body>

<h1>مرحبًا <?php echo $_SESSION["user"]["fullname"]; ?></h1>

<p>أهلاً بك في نظام إدارة المدرسة.</p>

<ul>
    <li><a href="modules/students/students.php">إدارة التلاميذ</a></li>
    <li><a href="modules/teachers/teachers.php">إدارة الأساتذة</a></li>
    <li><a href="modules/classes/classes.php">الأقسام</a></li>
    <li><a href="modules/subjects/subjects.php">المواد</a></li>
    <li><a href="modules/attendance/attendance.php">الحضور</a></li>
    <li><a href="modules/grades/grades.php">العلامات</a></li>
    <li><a href="modules/exams/exams.php">الامتحانات</a></li>
    <li><a href="modules/reports/reports.php">التقارير</a></li>
    <li><a href="modules/fees/fees.php">الرسوم</a></li>
    <li><a href="logout.php">تسجيل الخروج</a></li>
</ul>

</body>
</html>