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
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <?php require 'include/nav.php'; ?>
    <?php require 'include/postForm.php'; ?>
    <div class="wrapper-form">
        <div class="iForm__container">
            <form enctype="multipart/form-data" method="post"
                action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php">
                <div class="iForm__text">
                        <h1 class="iForm__title">WHAT'S HAPPENING</h1>
                    </div>
                    <div class="iForm__content">
                        <input type="text-area" name="msg" class="iForm__content__input"
                            placeholder="MESSAGE" id="content">
                    </div>
                    <div class="iForm__button_bottom">
                    <input type="file" name="file" id="file" style="display:none;" class="post__img-container">
                        <label for="file" class="post__img-container">Upload Picture</label>
                        <span id="pfp-input-value" class="post__img-container"></span>
                        <button type="submit" name="submit" class="iForm__btn">POST</button>
                    </div>
            </form>
        </div> 
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