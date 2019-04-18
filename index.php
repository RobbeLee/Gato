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
        <div class="iForm__container">
            <form enctype="multipart/form-data" method="post"
                action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php">
                <div class="iForm__text">
                    <div class="iForm__border">
                        <h1 class="iForm__title"> How about a post? </h1>
                    </div>
                    <div class="iForm__content">
                        <input type="text-area" name="msg" class="iForm__content__input"
                            placeholder="What is on your mind?" id="content">
                    </div>
                    <div class="iForm__button__bottom">
                        <input type="file" name="file" id="file" class="file__label"/>
                        <button type="submit" name="submit" class="iForm__btn">Submit</button>
                    </div>
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