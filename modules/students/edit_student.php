<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("التلميذ غير موجود.");
}

if (isset($_POST['update'])) {

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $gender    = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $class     = $_POST['class'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];

    $stmt = $pdo->prepare("
        UPDATE students
        SET firstname=?, lastname=?, gender=?, birthdate=?, class=?, phone=?, address=?
        WHERE id=?
    ");

    $stmt->execute([
        $firstname,
        $lastname,
        $gender,
        $birthdate,
        $class,
        $phone,
        $address,
        $id
    ]);

    header("Location: students.php");
    exit;
}
?>

<h2>تعديل بيانات التلميذ</h2>

<form method="post">

<p>الاسم</p>
<input type="text" name="firstname" value="<?= htmlspecialchars($student['firstname']) ?>" required>

<p>اللقب</p>
<input type="text" name="lastname" value="<?= htmlspecialchars($student['lastname']) ?>" required>

<p>الجنس</p>
<select name="gender">
    <option value="ذكر" <?= $student['gender']=="ذكر" ? "selected" : "" ?>>ذكر</option>
    <option value="أنثى" <?= $student['gender']=="أنثى" ? "selected" : "" ?>>أنثى</option>
</select>

<p>تاريخ الميلاد</p>
<input type="date" name="birthdate" value="<?= $student['birthdate'] ?>">

<p>القسم</p>
<input type="text" name="class" value="<?= htmlspecialchars($student['class']) ?>">

<p>الهاتف</p>
<input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>">

<p>العنوان</p>
<textarea name="address"><?= htmlspecialchars($student['address']) ?></textarea>

<br><br>

<button type="submit" name="update">💾 حفظ التعديلات</button>

</form>

<?php
require_once "../../includes/footer.php";
?>