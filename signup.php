<!-- "Matthijs" ik heb de signup.php verbeterd, nu moet het alleen nog aan een database gekoppeld worden. -->
<!-- Mike - 13/03/19 - Heb php_header toe gevoegt en heb de titel veranderd -->
<!-- "Matthijs" - 20/03/2019 - ik heb de home knop toegevoegt en de button mooi gemaakt met de hover-->
<?php require 'include/php_header.php';
$subFolder = false;
$_TITLE = "Sign Up | ".$_BRAND;
$_PAGE = "signup";

if (isset($_GET['error'])) {
    $error = filter_var($_GET['error'], FILTER_VALIDATE_INT);
    switch ($error) {
        case 0:
        $message = "Not every field has been filled in. ";
        break;
        case 1:
        $message = "The password/username/name includes invalid characters (only a-z A-Z 0-9 allowed).";
        break;
        case 2:
        $message = "The name/username/password was longer than 60 characters.";
        break;
        case 3:
        $message = "Invalid email address.";
        break;
        case 4:
        $message = "This email/username already exists.";
        break;
        default:
        $message="Error not found.";
            break;
    }

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
        <h2>Registration</h2>
        </div>
        <?php if (isset($_GET['error'])): ?>
        <span><?=htmlspecialchars($message)?></span>
        <?php endif; ?>
        <form method="POST" action="api/account/signup.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <input type="text" name="name" placeholder="Full Name" class="div__container__info" required>
            <input type="text" name="username" placeholder="Username" class="div__container__info" required>
            <input type="password" name="password" placeholder="Password" class="div__container__info" required>
            <button class="button" type="submit" name="submit">SIGN UP</button>
        </form>
        <div id="div__container__registration">
            <h4>Already have an account?</h4>
            <a href="./login">Click here</a>

            <h4>Forgot password?</h4>
            <a href="forgot_password">Click here</a>
        </div>
   </div>
   <?php require 'include/footer.php'; ?>
</body>
</html> 