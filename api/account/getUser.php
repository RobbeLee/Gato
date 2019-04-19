<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    exit;
}

$uid = $_GET['uid'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1;");

if (!$stmt->execute([$uid])) {
    echo "FATAL ERROR";
    exit;
}

$result = $stmt->fetch();

echo json_encode($result);
exit;