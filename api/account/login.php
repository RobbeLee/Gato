<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_POST['submit'])) {
    header("Location: ../../");
    exit;
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: ../../login?error=0");
    exit;
}

$email = strtolower($_POST['email']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
$stmt->execute([$email]);
$result = $stmt->fetch();

if ($stmt->rowCount() == 0) {
    header("Location: ../../login?error=1");
    exit;
}

if ($email !== $result['email']) {
    header("Location: ../../login?error=2");
    exit;
}

if (!password_verify($password, $result['password'])) {
    header("Location: ../../login?error=3");
    exit;
}

$_SESSION['id'] = $result['id'];
$_SESSION['name'] = $result['name'];
$_SESSION['username'] = $result['username'];
$_SESSION['email'] = $result['email'];

header("Location: ../../");
exit;