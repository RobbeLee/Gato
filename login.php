<!-- 'Matthijs' 13-03-2019, ik heb de login pagina gemaakt en de "dont have an account yet" gekoppeld aan de local host van signup-->
<!-- "Matthijs" - 20/03/2019 - ik heb de home knop toegevoegt en de button mooi gemaakt met de hover-->

<?php require 'include/php_header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
    <title>Sign up - <?=$_BRAND ?></title>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/signup.css" />
</head>
<body>
    <div id="container">
            <img src="assets/images/logo/hop_github_logo.svg" alt="logo" id="body__container__logo">
        <div id="div__container__tekst">
            <a href="./" class="container__brand">Gato</a>
            <h2>Login</h2>
        </div>
        <form method="POST" action="api/account/login.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <input type="password" name="password" placeholder="Password" class="div__container__info" required>
            <button class="button" type="submit" name="submit">LOGIN</button>
        </form>
        <!--<input type="button" class="button" value="Register"> -->
         <div id="div__container__registration">
            <h4>Don't have an account yet?</h4>
         <a href="./signup">Click here</a>

            <h4>Forgot password?</h4>
                <a href="./">Click here</a>
        </div>
   </div>
</body>
</html>