<!-- "Matthijs" ik heb de signup.php verbeterd, nu moet het alleen nog aan een database gekoppeld worden. -->
<!-- Mike - 13/03/19 - Heb php_header toe gevoegt en heb de titel veranderd -->
<!-- "Matthijs" - 20/03/2019 - ik heb de home knop toegevoegt en de button mooi gemaakt met de hover-->
<?php require 'include/php_header.php';
$subFolder = false;
$_TITLE = "Sign Up | ".$_BRAND;
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
        <h2>Registration</h2>
        </div>
        <form method="POST" action="api/account/signup.php">
            <input type="email" name="email" placeholder="Email" class="div__container__info" required>
            <input type="text" name="name" placeholder="Full Name" class="div__container__info" required>
            <input type="text" name="username" placeholder="Username" class="div__container__info" required>
            <input type="password" name="password" placeholder="Password" class="div__container__info" required> 
            <form action="http://localhost:8888/GitHub/Gato/">     
            <button class="button" type="submit" name="submit" >REGISTER</button>
        </form>
  </form> 
   </div>
</body>
</html>