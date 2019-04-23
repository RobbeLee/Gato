<?php
require '../include/db.php';
require '../include/header.php';

// im gonna git commit suicide

if (!isset($_POST['submit'])) {
    header("Location: ../");
    exit;
}

$user_id = $_SESSION['user_id'];
$text = $_POST['text'];
$price = (double)$_POST['price'];
$expiry = date("Y-m-d H:i:s", time() + 88200);

$stmt = $conn->prepare("SELECT * FROM blacklist WHERE user_id=?");
$stmt->execute([$user_id]);
$blacklist = $stmt->fetch();

$experation = strtotime($blacklist['experation']);

if ($experation >= $_DATE) {
    $stmt = $conn->prepare("DELETE FROM blacklist WHERE user_id=?");
    $stmt->execute([$user_id]);
}

if ($blacklist) {
    echo '<span>Wacht 1 uur om weer te uploaden</span>';
    header("Location: ../upload?1=ye");
    exit;
}

$stmt = $conn->prepare("INSERT INTO blacklist (ip, user_id, experation) VALUES (?, ?, ?);");
$stmt->execute([$ip, $user_id, $expiry]);

if ($price < 10 || $price > 100) {
    header("Location: ../upload");
    exit;
}

if (!empty($text)) {
    if (strlen($text) >= 60) {
        header("Location: ../upload");
        exit;
    }

    $type = 0;
    $stmt = $conn->prepare("INSERT INTO items (user_id, content, type, price) VALUES (?, ?, ?, ?);");
    if (!$stmt->execute([$user_id, $text, $type, $price])) {
        echo '<span>Fatal error: query failed xd</span>';
        exit;
    }
    header("Location: ../upload");
    exit;
    die;
}

header("Location ../");
exit;

// assume user upload file
