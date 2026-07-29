<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>لوحة التحكم</title>

<style>

body{
margin:0;
font-family:Tahoma;
background:#f5f7fa;
}

.header{
background:#0d6efd;
color:white;
padding:15px;
font-size:22px;
text-align:center;
}

.container{
padding:20px;
}

.card{
background:white;
padding:20px;
margin-bottom:15px;
border-radius:10px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.menu{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:15px;
}

.item{
background:#0d6efd;
color:white;
padding:20px;
text-align:center;
border-radius:10px;
text-decoration:none;
font-size:18px;
transition:.3s;
}

.item:hover{
background:#084298;
}

</style>

</head>

<body>

<div class="header">

نظام إدارة المدرسة الخاصة

</div>

<div class="container">

<div class="card">

<h2>مرحبا بك</h2>

<p>لوحة التحكم الرئيسية.</p>

</div>

<div class="menu">

<a class="item" href="#">التلاميذ</a>

<a class="item" href="#">الأساتذة</a>

<a class="item" href="#">الأقسام</a>

<a class="item" href="#">الأولياء</a>

<a class="item" href="#">النقاط</a>

<a class="item" href="#">الغيابات</a>

<a class="item" href="#">المالية</a>

<a class="item" href="#">الإعدادات</a>

<a class="item" href="logout.php">تسجيل الخروج</a>

</div>

</div>

</body>

</html>
