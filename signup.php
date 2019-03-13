<!-- "Matthijs" ik heb de signup.php verbeterd, nu moet het alleen nog aan een database gekoppeld worden. -->
<!-- Mike - 13/03/19 - Heb php_header toe gevoegt en heb de titel veranderd -->

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
            <h1>Registration</h1>
        </div>
        <form method="POST" action="api/account/signup.php">
            <input type="text" name="email" placeholder="Email" class="div__container__info">
            <input type="text" name="name" placeholder="Full Name" class="div__container__info">
            <input type="text" name="username" placeholder="Username" class="div__container__info">
            <input type="text" name="password" placeholder="Password" class="div__container__info">
            <button class="button" type="submit" name="submit" >Register</button>
        </form>
        <!--<input type="button" class="button" value="Register"> -->
        <form action="http://localhost:8888/GitHub/Gato/">
  </form> 
   </div>
</body>
</html>