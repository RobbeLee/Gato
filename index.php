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
        <div class="wrapper-form">
                <form action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php" enctype="multipart/form-data" method="post">
                <h2 class="postmodal__title">What do you want to post today?</h2>
            <div class="postmodal__input-container">
                <textarea class="postmodal__textarea" name="msg" placeholder="Message..."></textarea>
                    <div class="postmodal__footer">
                    <input type="file" name="file" id="file" style="display:none;">
                    <label for="file" class="postmodal__label">Upload Picture</label>
                    <button type="submit" name="submit" class="postmodal__btn" id="postmodal__btn">post</button>
            </div>  
           </div>
        </form>
</div>   
    <div class="wrapper-post">
        <?php 
            $stmt = $conn->prepare("SELECT * FROM posts ORDER BY id DESC");
            
            $stmt->execute();
            $posts = $stmt->fetchAll();
            
            foreach ($posts as $post): ?>
                <?php 
                    $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1;");
                    $stmt->execute([$post['uid']]);
                    $user = $stmt->fetch();
                    $pfp = "default";
                    if (file_exists("assets/userfiles/pfp/".$user['id'].".webp")) {
                        $pfp = $user['id'];
                    }
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
                        <div class="post__pfp-container">
                            <img class="post__pfp" src="assets/userfiles/pfp/<?=htmlspecialchars($pfp)?>.webp" alt="<?=htmlspecialchars($user['name'])?>" title="<?=htmlspecialchars($user['name'])?>">
                        </div>
                        <div class="post__user-container">
                            <div style="display:flex;flex-direction:column;">
                                <span class="post__name"><?=htmlspecialchars($user['name'])?></span>
                                <span class="post__username">@<?=htmlspecialchars($user['username'])?></span>
                            </div>
                            <span class="post__date"><?php echo htmlspecialchars(date('F d, Y', strtotime($post['date']))); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</body>
</html>