<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $subject_name = trim($_POST['subject_name']);
    $coefficient = trim($_POST['coefficient']);

    $stmt = $pdo->prepare("
        INSERT INTO subjects
        (subject_name, coefficient)
        VALUES (?, ?)
    ");

    $stmt->execute([
        $subject_name,
        $coefficient
    ]);

    header("Location: subjects.php");
    exit;
}
?>

<h2>إضافة مادة دراسية</h2>

<form method="post">

<p>اسم المادة</p>
<input type="text" name="subject_name" required>

<p>المعامل</p>
<input type="number" name="coefficient" min="1" value="1" required>

<br><br>

<button type="submit" name="save">
💾 حفظ المادة
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>