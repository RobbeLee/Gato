<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_GET['postID']) || empty($_GET['postID'])) {
    exit;
}

$postID = filter_var($_GET['postID'], FILTER_SANITIZE_STRING);
$liked = 0;

$stmt = $conn->prepare("SELECT * FROM liked WHERE uid=? AND postid=?;");

if (!$stmt->execute([$_SESSION['id'], $postID])) {
    exit;
}

$result = $stmt->fetch();

$userCheck = $conn->prepare("SELECT uid FROM posts WHERE id=?;");

if (!$userCheck->execute([$postID])) {
    exit;
}

$user = $userCheck->fetch();

if ($_SESSION['id'] == $user['uid']) {
    $liked = 0;
    echo $liked;
    exit;
}

if ($stmt->rowCount() == 0) {
    $stmt = $conn->prepare("INSERT INTO liked (uid, postid) VALUES (?, ?);");
    if (!$stmt->execute([$_SESSION['id'], $postID])) {
        exit;
    }
    $liked = 1;
} else {
    $stmt = $conn->prepare("DELETE FROM liked WHERE uid=? AND postid=?;");
    if (!$stmt->execute([$_SESSION['id'], $postID])) {
        exit;
    }
    if (!$stmt->execute([$_SESSION['id'], $postID])) {
        exit;
    }
    $liked = 0;
}

echo $liked;