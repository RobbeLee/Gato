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
    <link href="assets/css/post.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php require 'include/nav.php'; ?>
    <?php require 'include/postForm.php'; ?>
    <div>
        <?php 
            $stmt = $conn->prepare("SELECT * FROM posts;");
            $stmt->execute();
            $posts = $stmt->fetchAll();

            foreach ($posts as $post): ?>
                <div class="post">
                    <?php if (!is_null($post['uniqueid'])): ?>
                    <img src="./assets/userfiles/imgs/<?=$post['uniqueid']?>.webp" class="post__img">
                    <?php endif; ?>
                    <p class="post__content"><?=$post['content']?></p>
                </div>
            <?php endforeach; ?>
    </div>
</body>
</html>