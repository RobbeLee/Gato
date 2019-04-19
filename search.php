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
    <div class="posts">

    </div>
</div>
<script src="assets/js/ajax.js"></script>
</body> 
</html>