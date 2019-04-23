<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (isset($_SESSION['token'])) {
    $password = $_POST['password'];
    if (strlen($password) > 60) {
        header("Location: ../../forgot_password?error=6");
        exit;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT uid FROM tokens WHERE token=?;");
    if (!$stmt->execute([$_SESSION['token']])) {
        echo "FATAL ERROR";
        exit;
    }
    $result = $stmt->fetch();
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?;");
    if (!$stmt->execute([$password, $result['uid']])) {
        echo "FATAL ERROR";
        exit;
    }
    $stmt = $conn->prepare("DELETE FROM tokens WHERE token=?;");
    if (!$stmt->execute([$_SESSION['token']])) {
        echo "FATAL ERROR";
        exit;
    }
    $_SESSION['token'] = "";
    unset($_SESSION['token']);
    header("Location: ../../login");
    exit;
}

if (!isset($_POST['submit'])) {
    header("Location: ../../");
    exit;
}

if (empty($_POST['old-password']) || empty($_POST['new-password']) || empty($_POST['repeat-password'])) {
    header("Location: ../../account/settings?error=0");
    exit;
}

if (strlen($_POST['old-password']) > 60 || strlen($_POST['new-password']) > 60 || strlen($_POST['repeat-password']) > 60) {
    header("Location: ../../account/settings?error=1");
    exit;
}

$oldPass = $_POST['old-password'];
$newPass = $_POST['new-password'];
$repeatPass = $_POST['repeat-password'];

if ($newPass !== $repeatPass) {
    header("Location: ../../account/settings?error=2");
    exit;
}

$stmt = $conn->prepare("SELECT password FROM users WHERE id=? LIMIT 1;");

if (!$stmt->execute([$_SESSION['id']])) {
    echo "FATAL ERROR";
    exit;
}

$result = $stmt->fetch();

if (!password_verify($oldPass, $result['password'])) {
    header("Location: ../../account/settings?error=3");
    exit;
}

$newPass = password_hash($newPass, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?;");

if (!$stmt->execute([$newPass, $_SESSION['id']])) {
    echo "FATAL ERROR";
    exit;
}

header("Location: ../../account/settings?success");
exit;