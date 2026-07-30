<?php
require_once "config/database.php";

$username = "admin";
$password = password_hash("123456", PASSWORD_DEFAULT);
$fullname = "Administrator";

$stmt = $pdo->prepare("INSERT INTO users (username, password, fullname) VALUES (?, ?, ?)");

if ($stmt->execute([$username, $password, $fullname])) {
    echo "Admin created successfully";
} else {
    echo "Error";
}
?>