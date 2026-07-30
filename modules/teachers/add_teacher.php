<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $full_name = trim($_POST['full_name']);
    $specialty = trim($_POST['specialty']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $stmt = $pdo->prepare("
        INSERT INTO teachers
        (full_name, specialty, phone, email)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $full_name,
        $specialty,
        $phone,
        $email
    ]);

    header("Location: teachers.php");
    exit;
}
?>

<h2>إضافة أستاذ</h2>

<form method="post">

<p>الاسم الكامل</p>
<input type="text" name="full_name" required>

<p>التخصص</p>
<input type="text" name="specialty" required>

<p>رقم الهاتف</p>
<input type="text" name="phone">

<p>البريد الإلكتروني</p>
<input type="email" name="email">

<br><br>

<button type="submit" name="save">
💾 حفظ الأستاذ
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>