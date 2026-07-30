<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: subjects.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM subjects WHERE id=?");
$stmt->execute([$id]);
$subject = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subject) {
    die("المادة غير موجودة.");
}

if (isset($_POST['update'])) {

    $subject_name = trim($_POST['subject_name']);
    $coefficient = trim($_POST['coefficient']);

    $stmt = $pdo->prepare("
        UPDATE subjects
        SET subject_name=?, coefficient=?
        WHERE id=?
    ");

    $stmt->execute([
        $subject_name,
        $coefficient,
        $id
    ]);

    header("Location: subjects.php");
    exit;
}
?>

<h2>تعديل المادة</h2>

<form method="post">

<p>اسم المادة</p>
<input type="text" name="subject_name"
value="<?= htmlspecialchars($subject['subject_name']) ?>" required>

<p>المعامل</p>
<input type="number" name="coefficient"
value="<?= htmlspecialchars($subject['coefficient']) ?>" required>

<br><br>

<button type="submit" name="update">
💾 حفظ التعديلات
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>