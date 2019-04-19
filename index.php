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
            foreach ($posts as $post): 
        ?>
        <div class="post">
            <?php if (!is_null($post['uniqueid'])): ?>
            <div class="post__img-container">
                <img src="./assets/userfiles/imgs/<?=$post['uniqueid']?>.webp" class="post__img">
            </div>
            <?php endif; ?>
            <div class="post__content-container">
                <p class="post__content"><?=$post['content']?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>