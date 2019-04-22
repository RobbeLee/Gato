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
                <h1 class="header__name"><?=$result['name']; ?></h1>
                <span class="header__username">@<?=$result['username']; ?></span>
            </div>
        </div>
        <div id="header__links-container">
            <a href="#" id="links-posts" class="header__link">POST</a>
            <a href="#liked" id="links-liked" class="header__link">LIKED</a>
            <a href="#friends" id="links-friends" class="header__link">FRIENDS</a>
        </div>
    </div>
    <div class="container posts">
        <?php
            $stmt = $conn->prepare("SELECT * FROM posts WHERE uid=? ORDER BY id DESC;");
            $stmt->execute([$result['id']]);
            $posts = $stmt->fetchAll();

            foreach ($posts as $post): ?>
                <div class="post" <?php if (is_null($post['uniqueid'])) echo 'style="height:150px;"'; ?>>
                        <?php if (!is_null($post['uniqueid'])): ?>
                            <div class="post__img-container">
                                <img src="../assets/userfiles/imgs/<?=htmlspecialchars($post['uniqueid'])?>.webp" alt="error" class="post__img">
                            </div>
                        <?php endif; ?>
                    <p class="post__content">
                        <?=htmlspecialchars($post['content'])?>
                    </p>
                    <div class="post__body">
                        <div class="post__pfp-container">
                            <img class="post__pfp" src="<?=htmlspecialchars($userPfp)?>" alt="<?=htmlspecialchars($result['name'])?>" title="<?=htmlspecialchars($result['name'])?>">
                        </div>
                        <div class="post__user-container">
                            <div style="display:flex;flex-direction:column;">
                                <span class="post__name"><?=htmlspecialchars($result['name'])?></span>
                                <span class="post__username">@<?=htmlspecialchars($result['username'])?></span>
                            </div>
                            <span class="post__date"><?php echo htmlspecialchars(date('F d, Y', strtotime($post['date']))); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
    <div class="container liked">

    </div>
    <div class="container friends">

    </div>
    <?php require '../include/postForm.php'; ?>
    <script>
        let posts = document.querySelector("#links-posts"),
            liked = document.querySelector("#links-liked"),
            friends = document.querySelector("#links-friends");

        function checkFragment() {
            let fragment = window.location.hash.substring(1);
            switch (fragment) {
                case '':
                    posts.classList.add("header__link--active");
                    liked.classList.remove("header__link--active");
                    friends.classList.remove("header__link--active");
                    break;
                case 'liked':
                    posts.classList.remove("header__link--active");
                    liked.classList.add("header__link--active");
                    friends.classList.remove("header__link--active");
                    break;
                case 'friends':
                    posts.classList.remove("header__link--active");
                    liked.classList.remove("header__link--active");
                    friends.classList.add("header__link--active");
                    break;
                default:
                    posts.classList.add("header__link--active");
                    liked.classList.remove("header__link--active");
                    friends.classList.remove("header__link--active");
                    break;
            }
        }

        window.addEventListener('hashchange', () => {
            checkFragment();
        });

        checkFragment();
    </script>
</body>
</html>