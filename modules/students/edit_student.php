<?php
require_once "../../config/database.php";
require_once "../../includes/auth.php";
require_once "../../includes/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $gender    = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $class     = $_POST['class'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];

    $stmt = $pdo->prepare("
        UPDATE students SET
        firstname=?,
        lastname=?,
        gender=?,
        birthdate=?,
        class=?,
        phone=?,
        address=?
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

    echo "<p style='color:green'>تم تحديث بيانات التلميذ.</p>";

    $stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>تعديل بيانات التلميذ</h2>

<form method="POST">

الاسم:<br>
<input type="text" name="firstname"
value="<?= $student['firstname