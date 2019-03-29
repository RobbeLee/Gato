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
    <div class="header" id="container"> 
        <div class="header__body">
            <div class="header__pfp-container" id="container__pfp">
                <img class="header__pfp" src="<?=$userPfp?>" alt="error" class="container__pfp">
            </div>
            <div id="header__info">
                <h2 class="header__username">@<?=$result['username']; ?></h2>
                <span class="header__name"><?=$result['email']; ?></span>
            </div>
        </div>
        <div id="header__links-container">
            <a href="./" target="_blank" class="header__link">POST</a>
            <a href="./" target="_blank" id="ahref" class="header__link">FAVORITES</a>
            <a href="./" target="_blank" class="header__link">FRIENDS</a>
        </div>
    </div>
</body>
</html>