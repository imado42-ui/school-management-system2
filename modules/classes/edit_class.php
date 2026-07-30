<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: classes.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM classes WHERE id=?");
$stmt->execute([$id]);
$class = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$class) {
    die("القسم غير موجود.");
}

if (isset($_POST['update'])) {

    $class_name = trim($_POST['class_name']);
    $level = trim($_POST['level']);

    $stmt = $pdo->prepare("UPDATE classes SET class_name=?, level=? WHERE id=?");
    $stmt->execute([$class_name, $level, $id]);

    header("Location: classes.php");
    exit;
}
?>

<h2>تعديل القسم</h2>

<form method="post">

<p>اسم القسم</p>
<input type="text" name="class_name"
value="<?= htmlspecialchars($class['class_name']) ?>" required>

<p>المستوى</p>
<input type="text" name="level"
value="<?= htmlspecialchars($class['level']) ?>">

<br><br>

<button type="submit" name="update">
💾 حفظ التعديلات
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>