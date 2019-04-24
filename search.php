<?php
require 'include/php_header.php';
require 'include/db.php';

if (!isset($_GET['q']) || empty($_GET['q'])) {
    header("Location: ./");
    exit;
}

$subFolder = false;
$_TITLE = ucwords($_GET['q'])." | ".$_BRAND;
$_PAGE = "search";

$sql = "SELECT * FROM ";
$q = $_GET['q'];
$orderBy = null;

if (isset($_GET['type']) && !empty($_GET['type'])) {
    switch ($_GET['type']) {
        case "post":
            $sql = $sql."posts ";
            $orderBy = true;
            break;
        case "profile":
            $sql = $sql."users ";
            $orderBy = false;
            break;
        default:
            $sql = $sql."posts ";
            $orderBy = true;
            break;
    }
} else {
    $sql = $sql."posts ";
    $orderBy = true;
}

$sql = $sql."WHERE ";

if ($orderBy) {
    $sql = $sql."content LIKE concat('%', ?, '%') ";
} else {
    $sql = $sql."username LIKE concat('%', ?, '%') ";
}

$sql = $sql."ORDER BY id DESC LIMIT 15";

$stmt = $conn->prepare($sql);

if (!$stmt->execute([$_GET['q']])) {
    throw new error("Query error");
    exit;
}

$result = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
</head>
<body>
<?php require 'include/nav.php'; ?>

    <div class="wrapper">
        <div class="header">
            <h1 class="header__title"><?php echo htmlspecialchars($_GET['q']); ?></h1>
            <button class="header__btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/><path d="M0 0h24v24H0z" fill="none"/></svg></button>
        </div>
        <div class="results">
            <?php
            if ($stmt->rowCount() == 0) echo '<span>Nothing Found</span>';
            if ($orderBy):
                foreach ($result as $post): ?>
                <?php
                    $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1;");
                    $stmt->execute([$post['uid']]);
                    $user = $stmt->fetch();
                    $pfp = "default";
                    if (file_exists("assets/userfiles/pfp/".$user['id'].".webp")) $pfp = $user['id'];
                    $stmt = $conn->prepare("SELECT * FROM liked WHERE uid=? AND postid=?;");
                    $stmt->execute([$_SESSION['id'], $post['id']]);
                    $liked = false;
                    if ($stmt->rowCount() == 1) $liked = true;
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
            <?php endforeach;
            else:
                foreach ($result as $user): ?>
                <div class="user">
                    <div class="user__pfp-container">
                    <?php if (file_exists("assets/userfiles/pfp/".$user['id']."webp")): ?>
                        <img src="assets/userfiles/pfp/<?=$user['id']?>.webp" alt="<?=htmlspecialchars($user['name'])?>" class="user__pfp">
                    <?php else: ?>
                        <img src="assets/userfiles/pfp/default.webp" alt="<?=htmlspecialchars($user['name'])?>" class="user__pfp">
                    <?php endif; ?>
                    </div>
                    <div class="user__body">
                        <h2 class="user__name"><?=htmlspecialchars($user['name'])?></h2>
                        <span class="user__username"><?=htmlspecialchars($user['username'])?></span>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
    <?php require 'include/postForm.php'; ?>
</body> 
</html>