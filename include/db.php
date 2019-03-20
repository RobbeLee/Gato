<?php

// Mike - 15/02/19

require_once dirname(__FILE__). DIRECTORY_SEPARATOR.'config.php';
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    echo 'FATAL ERROR: '.$error->getMessage();
    exit;
    die;
}