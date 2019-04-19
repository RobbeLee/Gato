<?php
require '../../include/db.php';
require '../../include/php_header.php';

if (!isset($_POST['submit']) || !isset($_SESSION['id'])) {
    exit;
}

if (empty($_POST['msg'])) {
    exit;
}

$uniqueid = NULL;

if ($_FILES['file']['size'] > 0) {
    if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        echo "Sorry, you haven't chosen a file";
    } else {
        $allowed = ['png', 'jpg', 'jpeg', 'gif'];
        $fileExt = explode(".", $_FILES['file']['name']);
        $fileActExt = strtolower(end($fileExt));
        if (!in_array($fileActExt, $allowed)) {
            echo "sorry we don't support that kind of file.";
        } else {
            if ($_FILES['file']['size'] > 5097152) {
                echo "Your file is too big, sorry.";
            } else {
                $uniqueid = uniqid('', true);
                $path = "../../assets/userfiles/imgs/".$uniqueid.".webp";
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
    }
}
 
$msg = $_POST['msg'];
$date = date('Y-m-d H:i:s');

if (strlen($msg) > 240) {
    exit; // te veel characte
}

$stmt = $conn->prepare("INSERT INTO posts (uid, uniqueid, content, date) VALUES (?, ?, ?, ?);");

if (!$stmt->execute([$_SESSION['id'], $uniqueid, $msg, $date])) {
    exit; // werkt?
}

header("Location: ../../");
die; //mood
?>
