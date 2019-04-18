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
</head>
<body>
    <?php require '../include/nav.php'; ?>
    <div class="header" id="container"> 
        <div class="header__body">
            <div class="header__pfp-container" id="container__pfp">
                <img class="header__pfp container__pfp" src="<?=$userPfp?>" alt="<?=$result['name']?>" title="<?=$result['name']?>">
            </div>
            <div id="header__info">
                <h2 class="header__username">@<?=$result['username']; ?></h2>
                <span class="header__name"><?=$result['email']; ?></span>
            </div>
        </div>
        <div id="header__links-container">
            <a href="#" id="header__hover" class="header__link">POST</a>
            <a href="#liked" id="header__hover" class="header__link">LIKED</a>
            <a href="#friends" id="header__hover" class="header__link">FRIENDS</a>
        </div>
    </div>
    <div class="container posts">
        <?php
            $stmt = $conn->prepare("SELECT * FROM posts WHERE uid=? ORDER BY id DESC;");
            $stmt->execute([$result['id']]);
            $posts = $stmt->fetchAll();

            foreach ($posts as $post): ?>
                <div class="post">
                    <?php if (!is_null($post['uniqueid'])): ?>
                        <div class="post__img-container">
                            <img src="../assets/userfiles/imgs/<?=$post['uniqueid']?>.webp" alt="error" class="post__img">
                        </div>
                    <?php endif; ?>
                    <div class="post__body">
                        <span class="post__content">
                            <?=$post['content']?>
                        </span>
                        <span class="post__date"><?php echo date('F d, Y', strtotime($post['date'])); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
    <div class="container liked">

    </div>
    <div class="container friends">

    </div>
    <?php require '../include/postForm.php'; ?>
</body>
</html>