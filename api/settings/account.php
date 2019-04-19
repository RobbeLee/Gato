<?php
require '../../include/db.php';
require '../../include/php_header.php';

$errors = [];
$updates = [];
$values = [];

if (!isset($_SESSION['id']) && !isset($_POST['submit'])) {
    header("Location: ../../");
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        if (!$stmt->execute([$username])) {
            echo "Error";
            exit;
        }
        $result = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            if ($result['username'] == $username) {
                array_push($errors, 'Username already exists.');
                exit;
            }
        }
        array_push($values, $username);
        array_push($updates, 'username=?');
        rename("../../u/".strtolower($_SESSION['username']).".php", "../../u/".strtolower($username).".php");
    }
}

if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Your email is invalid.');
    } else {
        $email = strtolower($_POST['email']);
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        if (!$stmt->execute([$email])) {
            echo "Error";
            exit;
        }
        $result = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            if ($result['email'] == $email) {
                array_push($errors, 'Email already exists.');
                exit;
            }
        }
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
                require 'ImageManipulator.php';
                $path = "../../assets/userfiles/pfp/".$_SESSION['id'].".webp";

                $im = new ImageManipulator($_FILES['file']['tmp_name']);
                $centreX = round($im->getWidth() / 2);
                $centreY = round($im->getHeight() / 2);

                $x1 = $centreX - 200;
                $y1 = $centreY - 200;

                $x2 = $centreX + 200;
                $y2 = $centreY + 200;

                $im->crop($x1, $y1, $x2, $y2); // takes care of out of boundary conditions automatically
                $im->save($path);
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