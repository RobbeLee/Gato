<!-- 'Matthijs' 13-03-2019, ik heb de login pagina gemaakt en de "dont have an account yet" gekoppeld aan de local host van signup-->

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
            <h1>Login</h1>
        </div>
        <form method="POST" action="api/account/signup.php">
            <input type="text" name="email" placeholder="Email" class="div__container__info">
            <input type="text" name="password" placeholder="Password" class="div__container__info">
        </form>
        <!--<input type="button" class="button" value="Register"> -->
        <form action="http://localhost:8888/GitHub/Gato/">
        <button class="button" type="submit" name="submit" >LOGIN</button>
         <div id="div__container__registration">
            <h4>Don't have an account yet?</h4>
            <h5>Click <a href="http://localhost:8888/GitHub/gato/signup.php">here</a></h5> 

            <h4>Forgot password?</h4>
            <h5>Click <a href="">here</a></h5> 
        </div>
  </form> 
   </div>
</body>
</html>