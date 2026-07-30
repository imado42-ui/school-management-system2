<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (isset($_POST['save'])) {

    $class_name = trim($_POST['class_name']);
    $level = trim($_POST['level']);

    if (!empty($class_name) && !empty($level)) {

        $stmt = $pdo->prepare("
            INSERT INTO classes (class_name, level)
            VALUES (?, ?)
        ");

        $stmt->execute([
            $class_name,
            $level
        ]);

        header("Location: classes.php");
        exit;
    }
}
?>

<h2>➕ إضافة قسم جديد</h2>

<form method="POST">

    <p>اسم القسم</p>
    <input
        type="text"
        name="class_name"
        required
    >

    <br><br>

    <p>المستوى</p>
    <input
        type="text"
        name="level"
        placeholder="مثال: السنة الأولى"
        required
    >

    <br><br>

    <button type="submit" name="save">
        💾 حفظ القسم
    </button>

</form>

<?php
require_once "../../includes/footer.php";
?>