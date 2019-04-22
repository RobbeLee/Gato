<?php
    require 'include/php_header.php';
    $subFolder = false;
    $_TITLE = "Forgot Password | ".$_BRAND;
    $_PAGE = "signup";
?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
</head>
<body>
    <div id="container">
        <img src="assets/images/logo/hop_github_logo.svg" alt="logo" id="body__container__logo">
        <div id="div__container__tekst">
            <a href="./" class="container__brand">Gato</a>
            <h2>Forgot Password</h2>
        </div>
        <form method="POST" action="api/account/forgotPassword.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <button class="button" type="submit" name="submit">SEND</button>
        </form>
   </div>
   <?php require 'include/footer.php'; ?>
</body>
</html>