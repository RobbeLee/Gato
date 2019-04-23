<?php
    require 'include/php_header.php';
    $subFolder = false;
    $_TITLE = "Forgot Password | ".$_BRAND;
    $_PAGE = "signup";

    if (isset($_GET['error'])) {
        $error = filter_var($_GET['error'], FILTER_VALIDATE_INT);
        switch ($error) {
            case 1:
                $message = "Invalid email address.";
                break;
            case 2:
                $message = "Email was not found/incorrect.";
                break;
            case 3:
                $message = "You've already requested a password reset. Try again in 1 hour.";
                break;
            case 4:
                $message = "This token does not exist.";
                break;
            case 5:
                $message = "This token has already expired.";
                break;
            case 6:
                $message = "Your password cannot be longer than 60 characters.";
                break;
            default:
            $message = "";
                break;
        }
    
    } else if (isset($_GET['success'])) {
        $message = "Check your email to reset your password";
    }

    if (isset($_GET['token'])) {
        header("Location: api/account/forgotPassword.php?token=".$_GET['token']);
        exit;
    }
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
        <?php if (isset($_GET['error']) || isset($_GET['success'])): ?>
        <span <?php if (isset($_GET['success'])) echo 'style="color:green"'; ?>><?=htmlspecialchars($message)?></span>
        <?php endif; ?>
        <?php if (!isset($_SESSION['token'])): ?>
        <form method="POST" action="api/account/forgotPassword.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <button class="button" type="submit" name="submit">SEND</button>
        </form>
        <?php else: ?>
        <form method="POST" action="api/account/resetPassword.php">
            <input type="password" name="password" placeholder="New Password" class="div__container__info" required>
            <button class="button" type="submit" name="submit">RESET</button>
        </form>
        <?php endif; ?>
   </div>
   <?php require 'include/footer.php'; ?>
</body>
</html>