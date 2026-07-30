<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
$stmt->execute([$id]);
$class = $stmt->fetch();

if (!$class) {
    die("القسم غير موجود");
}

if (isset($_POST['update'])) {

    $class_name = trim($_POST['class_name']);
    $level = trim($_POST['level']);

    if (!empty($class_name) && !empty($level)) {

        $stmt = $pdo->prepare("
            UPDATE classes
            SET class_name = ?, level = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $class_name,
            $level,
            $id
        ]);

        header("Location: classes.php");
        exit;
    }
}
?>

<h2>✏️ تعديل القسم</h2>

<form method="POST">

    <p>اسم القسم</p>
    <input
        type="text"
        name="class_name"
        value="<?= htmlspecialchars($class['class_name']) ?>"
        required
    >

    <br><br>

    <p>المستوى</p>
    <input
        type="text"
        name="level"
        value="<?= htmlspecialchars($class['level']) ?>"
        required
    >

    <br><br>

    <button type="submit" name="update">
        💾 حفظ التعديلات
    </button>

</form>

<?php
require_once "../../includes/footer.php";
?>