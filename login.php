<?php
session_start();
require_once "config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user"] = $user;

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تسجيل الدخول</title>
</head>

<body>

<h2>تسجيل الدخول</h2>

<?php
if(isset($error)){
    echo "<p style='color:red'>$error</p>";
}
?>

<form method="POST">

<input type="text" name="username" placeholder="اسم المستخدم" required><br><br>

<input type="password" name="password" placeholder="كلمة المرور" required><br><br>

<button type="submit">دخول</button>

</form>

</body>
</html>