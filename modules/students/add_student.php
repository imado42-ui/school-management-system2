<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $gender    = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $class_id  = $_POST['class_id'];
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);

    $stmt = $pdo->prepare("
        INSERT INTO students
        (firstname, lastname, gender, birthdate, class_id, phone, address)
        VALUES (?,?,?,?,?,?,?)
    ");

    $stmt->execute([
        $firstname,
        $lastname,
        $gender,
        $birthdate,
        $class_id,
        $phone,
        $address
    ]);

    header("Location: students.php");
    exit;
}

$classes = $pdo->query("SELECT * FROM classes ORDER BY class_name")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>إضافة تلميذ</h2>

<form method="post">

<p>الاسم</p>
<input type="text" name="firstname" required>

<p>اللقب</p>
<input type="text" name="lastname" required>

<p>الجنس</p>
<select name="gender">
    <option value="ذكر">ذكر</option>
    <option value="أنثى">أنثى</option>
</select>

<p>تاريخ الميلاد</p>
<input type="date" name="birthdate">

<p>القسم</p>
<select name="class_id" required>

<?php foreach($classes as $class): ?>

<option value="<?= $class['id']; ?>">
    <?= htmlspecialchars($class['class_name']); ?>
</option>

<?php endforeach; ?>

</select>

<p>الهاتف</p>
<input type="text" name="phone">

<p>العنوان</p>
<textarea name="address"></textarea>

<br><br>

<button type="submit" name="save">
حفظ
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>