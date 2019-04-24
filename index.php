<?php
require 'include/db.php';
require 'include/php_header.php';
$subFolder = false;
$_TITLE = $_BRAND;
$_PAGE = "index";
?>

<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
</head>
<body>
    <?php require 'include/nav.php'; ?>
    <?php require 'include/postForm.php'; ?>
    <?php if (isset($_SESSION['id'])): ?>
    <form action="api/post/makePost.php" enctype="multipart/form-data" method="post" class="postmodal__form postform" style="margin:0 auto;">
        <span class="postmodal__title">Make new post</span>
        <div class="postmodal__input-container">
            <textarea class="postmodal__textarea" name="msg" style="background:transparent;" placeholder="Message..."></textarea>
            <div class="input-underline"></div>
        </div>
        <div class="postmodal__footer">
            <input type="file" name="file" id="file" style="display:none;">
            <label for="file" class="postmodal__label">Upload Picture</label>
            <button type="submit" name="submit" class="postmodal__btn" id="postmodal__btn">post</button>
        </div>
    </form>
    <?php endif; ?>
    <div class="wrapper-post" id="expand">
        <?php 
            $stmt = $conn->prepare("SELECT * FROM posts ORDER BY id DESC");
            
            $stmt->execute();
            $posts = $stmt->fetchAll();
        
            foreach ($posts as $post):
                    $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1;");
                    $stmt->execute([$post['uid']]);
                    $user = $stmt->fetch();
                    $pfp = "default";
                    if (file_exists("assets/userfiles/pfp/".$user['id'].".webp")) $pfp = $user['id'];
                    $liked = false;
                    if (isset($_SESSION['id'])) {
                        $stmt = $conn->prepare("SELECT * FROM liked WHERE uid=? AND postid=?;");
                        $stmt->execute([$_SESSION['id'], $post['id']]);
                        if ($stmt->rowCount() == 1) $liked = true;
                    }
                ?>
                <div class="post" <?php if (is_null($post['uniqueid'])) echo 'style="height:230px;"'; ?>>
                        <?php if (!is_null($post['uniqueid'])): ?>
                            <div class="post__img-container">
                                <img src="assets/userfiles/imgs/<?=htmlspecialchars($post['uniqueid'])?>.webp" alt="error" class="post__img">
                            </div>
                        <?php endif; ?>
                    <p class="post__content">
                        <?=htmlspecialchars($post['content'])?>
                    </p>
                    <div class="post__body">
                        <a href="u/<?=strtolower(htmlspecialchars($user['username']))?>" class="post__pfp-container">
                            <img class="post__pfp" src="assets/userfiles/pfp/<?=htmlspecialchars($pfp)?>.webp" alt="<?=htmlspecialchars($user['name'])?>" title="<?=htmlspecialchars($user['name'])?>">
                        </a>
                        <div class="post__user-container">
                            <div style="display:flex;flex-direction:column;">
                                <span class="post__name"><a href="u/<?=strtolower(htmlspecialchars($user['username']))?>"><?=htmlspecialchars($user['name'])?></a></span>
                                <span class="post__username"><a href="u/<?=strtolower(htmlspecialchars($user['username']))?>">@<?=htmlspecialchars($user['username'])?></a></span>
                            </div>
                            <span class="post__date"><?php echo htmlspecialchars(date('F d, Y', strtotime($post['date']))); ?></span>
                        </div>
                    </div>
                    <button class="post__like-btn <?php if ($liked) echo 'post__like-btn--liked'; ?>" data-id="<?=$post['id']?>"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></button>
                </div>
            <?php endforeach; ?>
    </div>
    <script src="assets/js/load.js"></script>
    <script src="assets/js/like.js"></script>
</body>
</html>