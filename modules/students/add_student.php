<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if (isset($_POST['save'])) {

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $gender    = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $class     = $_POST['class'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];

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

    echo "<p style='color:green'>تمت إضافة التلميذ بنجاح.</p>";
}
?>

<h2>إضافة تلميذ</h2>

<form method="POST">

الاسم:<br>
<input type="text" name="firstname" required><br><br>

اللقب:<br>
<input type="text" name="lastname" required><br><br>

الجنس:<br>
<select name="gender">
    <option value="ذكر">ذكر</option>
    <option value="أنثى">أنثى</option>
</select><br><br>

تاريخ الميلاد:<br>
<input type="date" name="birthdate"><br><br>

القسم:<br>
<input type="text" name="class"><br><br>

رقم الهاتف:<br>
<input type="text" name="phone"><br><br>

العنوان:<br>
<textarea name="address"></textarea><br><br>

<button type="submit" name="save">حفظ</button>

</form>

<?php
require_once "../../includes/footer.php";
?>