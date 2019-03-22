<?php
require '../include/db.php';
require '../include/php_header.php';
$subFolder = true;
$user = ucwords(basename($_URL));
$_TITLE = $user." | ".$_BRAND;
$_PAGE = "profile";
?>

<!DOCTYPE html>
<html>
<head>
    <?php require '../include/meta.php'; ?>
</head>
<body>
    <?php require '../include/nav.php'; ?>
    <div>
    </div>
</body>
</html>