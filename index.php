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
    <div class="wrapper-post">
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
                ?>
                <div class="post" <?php if (is_null($post['uniqueid'])) echo 'style="height:150px;"'; ?>>
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
                </div>
            <?php endforeach; ?>
    </div>
</body>
</html>