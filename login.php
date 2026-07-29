<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تسجيل الدخول - نظام إدارة المدرسة</title>

<style>
body{
    margin:0;
    font-family:Tahoma;
    background:#f2f5f9;
}
.login-box{
    width:350px;
    margin:80px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,.15);
}
h2{
    text-align:center;
    color:#0d6efd;
}
input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:6px;
    box-sizing:border-box;
}
button{
    width:100%;
    padding:12px;
    background:#0d6efd;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#0b5ed7;
}
</style>

</head>

<body>

<div class="login-box">

<h2>نظام إدارة المدرسة</h2>

<form action="" method="post">

<input type="text" name="username" placeholder="اسم المستخدم">

<input type="password" name="password" placeholder="كلمة المرور">

<button type="submit">تسجيل الدخول</button>

</form>

</div>

</body>
</html>
