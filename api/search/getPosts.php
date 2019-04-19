<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_GET['q']) || empty($_GET['q'])) {
    exit;
}

$q = $_GET['q'];
$orderby = NULL;

if (isset($_GET['orderby'])) {
    $key = filter_var($_GET['orderby'], FILTER_SANITIZE_INT);
    switch ($key) {
        case 1:
            $orderby = " ORDER BY date DESC";
            break;
        case 2:
            $orderby = " ORDER BY date ASC";
            break;
        default:
            $orderby = NULL;
            break;
    }
}

$sql = "SELECT * FROM posts WHERE content LIKE concat('%', ?, '%');";

if (!is_null($orderby)) $sql = $sql.$orderby;

$stmt = $conn->prepare($sql);

if (!$stmt->execute([$q])) {
    echo "FATAL ERROR";
    exit;
}

$result = $stmt->fetchAll();

echo json_encode($result);
exit;