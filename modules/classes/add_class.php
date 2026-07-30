<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $class_name = trim($_POST['class_name']);
    $level = trim($_POST['level']);

    if($class_name != ""){

        $stmt = $pdo->prepare("INSERT INTO classes (class_name, level) VALUES (?, ?)");
        $stmt->execute([$class_name, $level]);

        header("Location: classes.php");
        exit;
    }
}
?>

<h2>إضافة قسم جديد</h2>

<form method="post">

<p>اسم القسم</p>
<input type="text" name="class_name" required>

<p>المستوى</p>
<input type="text" name="level" placeholder="مثال: السنة الأولى">

<br><br>

<button type="submit" name="save">💾 حفظ القسم</button>

</form>

<?php
require_once "../../includes/footer.php";
?>