<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $conn->prepare("SELECT * FROM tokens WHERE token=? LIMIT 1;");
    if (!$stmt->execute([$token])) {
        echo "FATAL ERROR";
        exit;
    }
    if ($stmt->rowCount() == 0) {
        header("Location: ../../forgot_password?error=4");
        exit;
    }
    $result = $stmt->fetch();
    if ($result['date'] < date("Y-m-d H:m:i")) {
        $stmt = $conn->prepare("DELETE FROM tokens WHERE id=?;");
        if (!$stmt->execute([$result['id']])) {
            echo "FATAL ERROR";
            exit;
        }
        header("Location: ../../forgot_password?error=5");
        exit;
    }
    $_SESSION['token'] = $token;
    header("Location: ../../forgot_password");
    exit;
}

if (!isset($_POST['submit']) || !isset($_POST['email']) || empty($_POST['email'])) {
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

$user = $stmt->fetch();

if ($stmt->rowCount() == 0 || $user['email'] !== $email) {
    header("Location: ../../forgot_password?error=2");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tokens WHERE uid=? LIMIT 1;");

if (!$stmt->execute([$user['id']])) {
    echo "FATAL ERROR";
    exit;
}

$result = $stmt->fetch();

if ($stmt->rowCount() > 0) {
    $date = $result['date'];
    if ($date > date("Y-m-d H:m:i")) {
        header("Location: ../../forgot_password?error=3");
        exit;
    } else {
        $stmt = $conn->prepare("DELETE FROM tokens WHERE id=?;");
        if (!$stmt->execute([$result['id']])) {
            echo "FATAL ERROR";
            exit;
        }
    }
}

$token = generateRandomString(80);
$date = date("Y-m-d H:m:i", strtotime('+1 hour'));

$stmt = $conn->prepare("INSERT INTO tokens (uid, token, date) VALUES (?, ?, ?)");

if (!$stmt->execute([$user['id'], $token, $date])) {
    echo "FATAL ERROR";
    exit;
}

$message = 'Click the link below to change your password.\n<a href="25933.hosts2.ma-cloud.nl/gato/forgot_password?token='.$token.'" target="_about"></a>';

mail($email, "Forgot Password", $message, 'From: noreply@gato.com');

header("Location: ../../forgot_password?success");
exit;