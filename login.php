<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit;
}

include "includes/header.php";
?>

<h2>تسجيل الدخول</h2>

<form action="index.php" method="POST">
    <label>اسم المستخدم</label><br>
    <input type="text" name="username" required><br><br>

    <label>كلمة المرور</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">دخول</button>
</form>

<?php
include "includes/footer.php";
?>