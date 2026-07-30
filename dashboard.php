<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "includes/header.php";
include "includes/sidebar.php";
?>

<div style="margin-left:270px;padding:20px;">

    <h2>لوحة التحكم</h2>

    <p>مرحباً <?php echo $_SESSION['username']; ?></p>

    <hr>

    <h3>إحصائيات النظام</h3>

    <ul>
        <li>👨‍🎓 عدد الطلاب</li>
        <li>👨‍🏫 عدد الأساتذة</li>
        <li>🏫 عدد الأقسام</li>
        <li>📚 عدد المواد</li>
    </ul>

</div>

<?php
include "includes/footer.php";
?>