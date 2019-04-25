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
        $message = "";
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
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="223.31px" height="217.38px" viewBox="0 0 223.31 217.38" style="enable-background:new 0 0 223.31 217.38;"xml:space="preserve"><style type="text/css">.st0{fill:#020202;stroke:#020202;stroke-miterlimit:10;}</style><defs></defs><path class="st0" d="M111.66,0.5C50.27,0.5,0.5,50.27,0.5,111.66c0,48.73,31.36,90.14,75.01,105.14l2.81-3.35c9.65-14.2,6.18-30.12,6.18-30.12c-0.96-6.08-4.26-10.39-10.06-12.13c-6.37-1.91-12.74-3.78-19.11-5.7c-5.73-1.72-9.92-5.02-11.24-11.67c-0.3-1.49-1.79-2.68-2.53-4.12c-1.48-2.9-2.85-5.88-4.22-8.84c-0.53-1.15-0.81-2.47-1.47-3.52c-3.8-6.09-4.08-12.19,0.68-17.11c7.5-7.75,10.88-17.4,14.33-27.54c6.44-18.92,19.24-31.57,37.26-38.07c1.52-0.55,3.04-1.13,4.6-1.53c4.27-1.1,4.68-4.2,3.59-7.92c-1.7-5.81-3.63-11.55-5.28-17.37c-0.69-2.43-0.91-5.01-1.42-7.98c7.75-0.47,9.8,6.86,14.52,9.63c4.41-6.3,4.77-6.8,10.58-2.12c18.25,14.71,36.88,29.02,54.08,45.03c17.29,16.09,25.12,38.43,30.78,61.61c2.67,10.93,5.48,21.83,8.68,32.59c9.23-16.2,14.52-34.93,14.52-54.91C222.81,50.27,173.04,0.5,111.66,0.5z"/></svg>
        <div id="div__container__tekst">
        <a href="./" class="container__brand">Gato</a>          
        <h2>Registration</h2>
        </div>
        <?php if (isset($_GET['error'])): ?>
        <span><?=htmlspecialchars($message)?></span>
        <?php endif; ?>
        <form method="POST" action="api/account/signup.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <input type="text" name="name" placeholder="Name" class="div__container__info" required>
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