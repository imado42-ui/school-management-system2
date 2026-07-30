<?php
session_start();
require_once "config/database.php";

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $error = "يرجى إدخال اسم المستخدم وكلمة المرور.";
    }else{

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if($user && password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit();

        }else{
            $error = "بيانات الدخول غير صحيحة.";
        }
    }
}
?>

<?php include "includes/header.php"; ?>

<div class="login-box">

    <h2>تسجيل الدخول</h2>

    <?php if($error!=""){ ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">

        <input type="text" name="username" placeholder="اسم المستخدم" required>

        <br><br>

        <input type="password" name="password" placeholder="كلمة المرور" required>

        <br><br>

        <button type="submit" name="login">دخول</button>

    </form>

</div>

<?php include "includes/footer.php"; ?>