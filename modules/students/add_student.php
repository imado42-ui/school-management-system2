<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

if(isset($_POST['save'])){

    $registration_number = $_POST['registration_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $class_id = $_POST['class_id'];

    $stmt = $pdo->prepare("INSERT INTO students(registration_number, first_name, last_name, class_id)
                           VALUES(?,?,?,?)");

    $stmt->execute([
        $registration_number,
        $first_name,
        $last_name,
        $class_id
    ]);

    echo "<p style='color:green;'>تمت إضافة التلميذ بنجاح.</p>";
}
?>

<h2>إضافة تلميذ</h2>

<form method="POST">

رقم التسجيل:<br>
<input type="text" name="registration_number"><br><br>

الاسم:<br>
<input type="text" name="first_name"><br><br>

اللقب:<br>
<input type="text" name="last_name"><br><br>

القسم:<br>
<input type="number" name="class_id"><br><br>

<button type="submit" name="save">حفظ</button>

</form>

<?php
require_once "../../includes/footer.php";
?>