<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$classes = $pdo->query("SELECT * FROM classes ORDER BY class_name")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $class = $_POST['class'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("
        INSERT INTO students
        (firstname, lastname, gender, birthdate, class, phone, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $firstname,
        $lastname,
        $gender,
        $birthdate,
        $class,
        $phone,
        $address
    ]);

    header("Location: students.php");
    exit;
}
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
<select name="class" required>
    <option value="">اختر القسم</option>

    <?php foreach($classes as $row): ?>

        <option value="<?= $row['class_name']; ?>">
            <?= $row['class_name']; ?> - <?= $row['level']; ?>
        </option>

    <?php endforeach; ?>

</select>

<p>رقم الهاتف</p>
<input type="text" name="phone">

<p>العنوان</p>
<textarea name="address"></textarea>

<br><br>

<button type="submit" name="save">
💾 حفظ التلميذ
</button>

</form>

<?php
require_once "../../includes/footer.php";
?>