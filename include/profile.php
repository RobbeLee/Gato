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

$friend = false;
if (isset($_SESSION['id'])) {
    $stmt = $conn->prepare("SELECT * FROM friends WHERE uid=? AND friendid=?;");
    $stmt->execute([$_SESSION['id'], $result['id']]);
    if ($stmt->rowCount() == 1) $friend = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require '../include/meta.php'; ?>
</head>
<body>
    <?php require '../include/nav.php'; ?>
    <div class="header"> 
        <div class="header__body">
            <div class="header__pfp-container" id="container__pfp">
                <img class="header__pfp container__pfp" src="<?=$userPfp?>" alt="<?=htmlspecialchars($result['name'])?>" title="<?=htmlspecialchars($result['name'])?>">
            </div>
            <div class="header__info">
                <h1 class="header__name"><?=htmlspecialchars($result['name'])?></h1>
                <span class="header__username">@<?=htmlspecialchars($result['username'])?></span>
                <button class="header__follow-btn <?php if ($friend) echo "header__follow-btn--friend" ?>" data-id="<?=$result['id']?>">friend</button>
                <p class="header__bio"><?=htmlspecialchars($result['bio'])?></p>
            </div>
        </div>
        <div class="header__links-container">
            <a href="#posts" id="links-posts" class="header__link">POST</a>
            <a href="#liked" id="links-liked" class="header__link">LIKED</a>
            <a href="#friends" id="links-friends" class="header__link">FRIENDS</a>
        </div>
    </div>
    <div class="container posts">
        <?php
            $stmt = $conn->prepare("SELECT * FROM posts WHERE uid=? ORDER BY id DESC;");
            $stmt->execute([$result['id']]);
            $posts = $stmt->fetchAll();

            foreach ($posts as $post):
                $liked = false;
                if (isset($_SESSION['id'])) {
                    $stmt = $conn->prepare("SELECT * FROM liked WHERE uid=? AND postid=?;");
                    $stmt->execute([$_SESSION['id'], $post['id']]);
                    if ($stmt->rowCount() == 1) $liked = true;
                }
            ?>
                <div class="post" <?php if (is_null($post['uniqueid'])) echo 'style="height:230px;"'; ?>>
                    <div class="post__img-container" <?php if (is_null($post['uniqueid'])) echo 'style="height:0px;"' ?>>
                        <?php if (!is_null($post['uniqueid'])): ?>
                        <img src="../assets/userfiles/imgs/<?=htmlspecialchars($post['uniqueid'])?>.webp" alt="error" class="post__img">
                        <?php endif; ?>
                    </div>
                    <p class="post__content">
                        <?=htmlspecialchars($post['content'])?>
                    </p>
                    <div class="post__body">
                        <a href="../u/<?=strtolower(htmlspecialchars($user['username']))?>" class="post__pfp-container">
                            <img class="post__pfp" src="<?=htmlspecialchars($userPfp)?>" alt="<?=htmlspecialchars($result['name'])?>" title="<?=htmlspecialchars($result['name'])?>">
                        </a>
                        <div class="post__user-container">
                            <div style="display:flex;flex-direction:column;">
                                <span class="post__name"><a href="../u/<?=strtolower(htmlspecialchars($result['username']))?>"><?=htmlspecialchars($result['name'])?></a></span>
                                <span class="post__username"><a href="../u/<?=strtolower(htmlspecialchars($result['username']))?>">@<?=htmlspecialchars($result['username'])?></a></span>
                            </div>
                            <span class="post__date"><?php echo htmlspecialchars(date('F d, Y', strtotime($post['date']))); ?></span>
                        </div>
                    </div>
                    <button class="post__like-btn <?php if ($liked) echo 'post__like-btn--liked'; ?>" data-liked="<?php if ($liked) { echo "1"; } else { echo "0"; }?>" data-id="<?=$post['id']?>"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></button>
                </div>
            <?php endforeach; ?>
    </div>
    <div class="container liked">
        <?php
        $stmt = $conn->prepare("SELECT postid FROM liked WHERE uid=? ORDER BY id DESC;");
        $stmt->execute([$result['id']]);
        $likedPosts = $stmt->fetchAll();

        foreach ($likedPosts as $likedPost):
            $stmt = $conn->prepare("SELECT * FROM posts WHERE id=? ORDER BY id DESC;");
            $stmt->execute([$likedPost['postid']]);
            $post = $stmt->fetch();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1;");
            $stmt->execute([$post['uid']]);
            $user = $stmt->fetch();
            $liked = false;
            if (isset($_SESSION['id'])) {
                $stmt = $conn->prepare("SELECT * FROM liked WHERE uid=? AND postid=?;");
                $stmt->execute([$_SESSION['id'], $post['id']]);
                if ($stmt->rowCount() == 1) $liked = true;
            }
            $userPfp = "default";
            if (file_exists("../assets/userfiles/pfp/".$user['id'].".webp")) {
                $userPfp = $user['id'];
            }
            ?>
            <div class="post" <?php if (is_null($post['uniqueid'])) echo 'style="height:230px;"'; ?>>
                <div class="post__img-container" <?php if (is_null($post['uniqueid'])) echo 'style="height:0px;"' ?>>
                    <?php if (!is_null($post['uniqueid'])): ?>
                    <img src="../assets/userfiles/imgs/<?=htmlspecialchars($post['uniqueid'])?>.webp" alt="error" class="post__img">
                    <?php endif; ?>
                </div>
                <p class="post__content">
                    <?=htmlspecialchars($post['content'])?>
                </p>
                <div class="post__body">
                    <a href="../u/<?=strtolower(htmlspecialchars($user['username']))?>" class="post__pfp-container">
                        <img class="post__pfp" src="../assets/userfiles/pfp/<?=htmlspecialchars($userPfp)?>.webp" alt="<?=htmlspecialchars($user['name'])?>" title="<?=htmlspecialchars($user['name'])?>">
                    </a>
                    <div class="post__user-container">
                        <div style="display:flex;flex-direction:column;">
                            <span class="post__name"><a href="../u/<?=strtolower(htmlspecialchars($user['username']))?>"><?=htmlspecialchars($user['name'])?></a></span>
                            <span class="post__username"><a href="../u/<?=strtolower(htmlspecialchars($user['username']))?>">@<?=htmlspecialchars($user['username'])?></a></span>
                        </div>
                        <span class="post__date"><?php echo htmlspecialchars(date('F d, Y', strtotime($post['date']))); ?></span>
                    </div>
                </div>
                <button class="post__like-btn <?php if ($liked) echo 'post__like-btn--liked'; ?>" data-liked="<?php if ($liked) { echo "1"; } else { echo "0"; }?>" data-id="<?=$post['id']?>"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container friends">
        <?php
            $stmt = $conn->prepare("SELECT friendid FROM friends WHERE uid=?;");
            $stmt->execute([$result['id']]);
            $friends = $stmt->fetchAll();

            foreach ($friends as $friend):
                $stmt = $conn->prepare("SELECT * FROM users WHERE id=?;");
                $stmt->execute([$friend['friendid']]);
                $friend = $stmt->fetch();
                $friendPfp = "default";
                if (file_exists("../assets/userfiles/pfp/".$friend['id'].".webp")) $friendPfp = $friend['id'];
                ?>
                <a href="../u/<?=strtolower(htmlspecialchars($friend['username']))?>" class="friend">
                    <div class="friend__pfp-container">
                        <img src="../assets/userfiles/pfp/<?=$friendPfp?>.webp" alt="<?=htmlspecialchars($friend['name'])?>" class="friend__pfp">
                    </div>
                    <div class="friend__body">
                        <span class="friend__name"><?=htmlspecialchars($friend['name'])?></span>
                        <span class="friend__username">@<?=htmlspecialchars($friend['username'])?></span>
                    </div>
                </a>
            <?php endforeach; ?>
    </div>
    <?php require '../include/postForm.php'; ?>
    <script>
        let postsLink = document.querySelector("#links-posts"),
            likedLink = document.querySelector("#links-liked"),
            friendsLink = document.querySelector("#links-friends"),
            posts = document.querySelector('.posts'),
            liked = document.querySelector('.liked'),
            friends = document.querySelector('.friends');

        function checkFragment() {
            let fragment = window.location.hash.substring(1);
            switch (fragment) {
                case 'posts':
                    postsLink.classList.add("header__link--active");
                    likedLink.classList.remove("header__link--active");
                    friendsLink.classList.remove("header__link--active");
                    posts.style.display = "flex";
                    liked.style.display = "none";
                    friends.style.display = "none";
                    <?php if (isset($_SESSION['id'])): ?>
                    document.querySelector(".user-nav__profile-friends").classList.remove("user-nav__link--active");
                    document.querySelector(".user-nav__profile-liked").classList.remove("user-nav__link--active");
                    <?php endif; ?>
                    break;
                case 'liked':
                    postsLink.classList.remove("header__link--active");
                    likedLink.classList.add("header__link--active");
                    friendsLink.classList.remove("header__link--active");
                    posts.style.display = "none";
                    liked.style.display = "flex";
                    friends.style.display = "none";
                    <?php if (isset($_SESSION['id'])): ?>
                    document.querySelector(".user-nav__profile-liked").classList.add("user-nav__link--active");
                    document.querySelector(".user-nav__profile-friends").classList.remove("user-nav__link--active");
                    <?php endif; ?>
                    break;
                case 'friends':
                    postsLink.classList.remove("header__link--active");
                    likedLink.classList.remove("header__link--active");
                    friendsLink.classList.add("header__link--active");
                    posts.style.display = "none";
                    liked.style.display = "none";
                    friends.style.display = "flex";
                    <?php if (isset($_SESSION['id'])): ?>
                    document.querySelector(".user-nav__profile-friends").classList.add("user-nav__link--active");
                    document.querySelector(".user-nav__profile-liked").classList.remove("user-nav__link--active");
                    <?php endif; ?>
                    break;
                default:
                    postsLink.classList.add("header__link--active");
                    likedLink.classList.remove("header__link--active");
                    friendsLink.classList.remove("header__link--active");
                    posts.style.display = "flex";
                    liked.style.display = "none";
                    friends.style.display = "none";
                    <?php if (isset($_SESSION['id'])): ?>
                    document.querySelector(".user-nav__profile-friends").classList.remove("user-nav__link--active");
                    document.querySelector(".user-nav__profile-liked").classList.remove("user-nav__link--active");
                    <?php endif; ?>
                    break;
            }
        }

        window.addEventListener('hashchange', () => {
            checkFragment();
        });

        checkFragment();
    </script>
    <?php require '../include/postModal.php'; ?>
    <?php if (isset($_SESSION['id'])): ?>
    <script src="../assets/js/like.js"></script>
    <script src="../assets/js/friend.js"></script>
    <?php endif; ?>
</body>
</html>