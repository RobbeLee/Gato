<?php
require '../include/db.php';
require '../include/php_header.php';
$subFolder = true;
$user = basename($_URL);
$_TITLE = ucwords($user)." | ".$_BRAND;
$_PAGE = "profile";

$stmt = $conn->prepare("SELECT * FROM users WHERE username=?;");
$stmt->execute([$user]);
$result = $stmt->fetch();
// SELECT * FROM users WHERE username=?;
$path = '../assets/userfiles/pfp/'.$result['id'].'.webp';
if (file_exists($path)) {
    $userPfp = $path;
} else {
    $userPfp = "assets/userfiles/pfp/default.webp";
    if ($subFolder) $userPfp = "../".$userPfp;
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require '../include/meta.php'; ?>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <?php require '../include/nav.php'; ?>
    <div id="container"> 
    <div id="container__pfp">
    <img src="<?=$userPfp?>" alt="error" class="container__pfp">
    <div id="container__info">
    <span class="user-nav__name"><?=$result['name']; ?></span>
    <h2 class="user-nav__username">@<?=$result['username']; ?></h2>
    </div>
</div>
    <div>
    </div>
    <div id="container__href">
    <a href="./" target="_blank" class="href">POST</a>
    <a href="./" target="_blank" id="ahref" class="href">FAVORITES</a>
    <a href="./" target="_blank" class="href">FRIENDS</a>
</div>
</body>
</html>