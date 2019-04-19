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
                    <textarea name="msg" class="iForm__content__input" cols="30" rows="10" id="content" placeholder="MESSAGE"></textarea>
                    </div>
                <div class="iform__test">
                    <div class="iForm__button_bottom">
                    <input type="file" name="file" id="file" style="display:none;" class="post__img-container">
                        <label for="file" class="post__img-container">Upload Picture</label>
                        <span id="pfp-input-value" class="post__img-container"></span>
                        <button type="submit" name="submit" class="iForm__btn">POST</button>
                    </div>
            </form>
            <button class="nav__btn" id="sortby" title="Sort By"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/><path d="M0 0h24v24H0z" fill="none"/></svg></button>
            </div> 
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