<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_POST['email']) || empty($_POST['email'])) {
    header("Location: ../../");
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../forgot_password?error=1");
    exit;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$email = $_POST['email'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1;");

if (!$stmt->execute([$email])) {
    echo "FATAL ERROR";
    exit;
}

$result = $stmt->fetch();

if ($result['email'] !== $email) {
    header("Location: ../../forgot_password?error=2");
    exit;
}

if ($result['id'] !== $_SESSION['id']) {
    header("Location: ../../forgot_password?error=3");
    exit;
}

$token = generateRandomString(80);
$date = date("Y-m-d H:m:i");
var_dump($date);

$stmt = $conn->prepare("INSERT INTO tokens (uid, token, date) VALUES (?, ?, ?)");

$message = 'Click the link below to change your password.\n<a href="25933.hosts2.ma-cloud.nl/gato/forgot_password" target="_about"></a>';

mail($email, "Forgot Password", $message, 'From: noreply@gato.com');