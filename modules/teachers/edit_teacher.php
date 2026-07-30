<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: teachers.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM teachers WHERE id=?");
$stmt->execute([$id]);
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher) {
    die("الأستاذ غير موجود.");
}

if (isset($_POST['update'])) {

    $full_name = trim($_POST['full_name']);
    $specialty = trim($_POST['specialty']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $stmt = $pdo->prepare("
        UPDATE teachers
        SET full_name=?, specialty=?, phone=?, email=?
        WHERE id=?
    ");

    $stmt->execute([
        $full_name,
        $specialty,
        $phone,
        $email,
        $id
    ]);

    header("Location: teachers.php");
    exit;
}
?>

<h2>تعديل بيانات الأستاذ</h2>

<form method="post">

<p>الاسم الكامل</p>
<input type="text" name="full_name" value="<?= htmlspecialchars($teacher['full_name']) ?>" required>

<p>التخصص</p>
<input type="text" name="specialty" value="<?= htmlspecialchars($teacher['specialty']) ?>" required>

<p>رقم الهاتف</p>
<input type="text" name="phone" value="<?= htmlspecialchars($teacher['phone']) ?>">

<p>البريد الإلكتروني</p>
<input type="email" name="email" value="<?= htmlspecialchars($teacher['email']) ?>">

<br><br>

<button type="submit" name="update">
💾 حفظ التعديلات
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>