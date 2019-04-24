<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_GET['friendID']) || empty($_GET['friendID'])) {
    exit;
}

$friendID = intval($_GET['friendID']);
$friend = 0;

$stmt = $conn->prepare("SELECT * FROM friends WHERE uid=? AND friendID=?;");

if (!$stmt->execute([$_SESSION['id'], $friendID])) {
    exit;
}

if ($_SESSION['id'] == $friendID) {
    $friend = 0;
    echo $friend;
    exit;
}

if ($stmt->rowCount() == 0) {
    $stmt = $conn->prepare("INSERT INTO friends (uid, friendID) VALUES (?, ?);");
    if (!$stmt->execute([$_SESSION['id'], $friendID])) {
        exit;
    }
    $friend = 1;
} else {
    $stmt = $conn->prepare("DELETE FROM friends WHERE uid=? AND friendID=?;");
    if (!$stmt->execute([$_SESSION['id'], $friendID])) {
        exit;
    }
    if (!$stmt->execute([$_SESSION['id'], $friendID])) {
        exit;
    }
    $friend = 0;
}

echo $friend;