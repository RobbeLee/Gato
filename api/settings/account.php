<?php
require '../../include/db.php';
require '../../include/php_header.php';

$errors = [];
$updates = [];
$values = [];

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
        array_push($values, $name);
        array_push($updates, 'name=?');
    }
}

if (!empty($_POST['username'])) {
    if (strlen($_POST['username']) > 60) {
        array_push($errors, 'Your username cannot be longer than 60 characters.');
    } else {
        $username = $_POST['username'];
        array_push($values, $username);
        array_push($updates, 'username=?');
    }
}

if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Your email is invalid.');
    } else {
        $email = $_POST['email'];
        array_push($values, $email);
        array_push($updates, 'email=?');
    }
}

if ($_FILES['file']['size'] > 0) {
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

if (count($updates) > 0) {
    for ($i=0; $i < count($updates); $i++) {
        if ($i !== count($updates) - 1) {
            $sql = $sql.$updates[$i].", ";
        } else {
            $sql = $sql.$updates[$i];
        }
    }
    $sql = $sql." WHERE id=?;";
    array_push($values, $_SESSION['id']);

    $stmt = $conn->prepare($sql);
    if (!$stmt->execute($values)) {
        throw new error("FATAL QUERY ERROR");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    $stmt->execute([$_SESSION['id']]);
    $result = $stmt->fetch();

    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['email'] = $result['email'];
}

header("Location: ../../account/settings");
exit;