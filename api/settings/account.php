<?php
require '../../include/db.php';
require '../../include/php_header.php';

$errors = [];
$updates = [];

if (!isset($_SESSION['id']) && !isset($_POST['submit'])) {
    header("Location: ../../?lenker");
    exit;
}

$sql = "UPDATE users SET ";

if (!empty($_POST['name'])) {
    if (strlen($_POST['name']) > 60) {
        array_push($errors, 'Your name cannot be longer than 60 characters.');
    } else {
        $name = $_POST['name'];
        array_push($updates, 'name=?');
    }
}

if (!empty($_POST['username'])) {
    if (strlen($_POST['username']) > 60) {
        array_push($errors, 'Your username cannot be longer than 60 characters.');
    } else {
        $username = $_POST['username'];
        array_push($updates, 'username=?');
    }
}

if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Your email is invalid.');
    } else {
        $email = $_POST['email'];
        array_push($updates, 'email=?');
    }
}

if (!empty($_FILES)) {
    if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        array_push($errors, 'File does not exist.');
    } else {
        $allowed = ['png', 'jpg', 'jpeg', 'gif'];
        $fileExt = explode(".", $_FILES['file']['name']);
        $fileActExt = strtolower(end($fileExt));
        if (!in_array($fileActExt, $allowed)) {
            array_push($errors, 'Unsupported file type.');
        } else {
            if ($_FILES['file']['size'] > 10485760) {
                array_push($errors, 'File size too large.');
            } else {
                if (file_exists('../../assets/userfiles/pfp/'.$_SESSION['id'].'.webp')) {
                    unlink('../../assets/userfiles/pfp/'.$_SESSION['id'].'.webp');
                }
                $path = "../../assets/userfiles/pfp/".$_SESSION['id'].".webp";
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
    }
}

if (count($errors) > 0) {
    echo "<pre>";
    print_r($errors);
    exit;
}

header("Location: ../../account/settings");
exit;