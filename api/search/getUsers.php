<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_POST['submit']) || !isset($_SESSION['id'])) {
    exit;
}

if (empty($_POST['msg'])) {
    exit;
}
