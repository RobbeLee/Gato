<!DOCTYPE html>
<!-- "Matthijs" ik heb de signup.php verbeterd, nu moet het alleen nog aan een database gekoppeld worden. -->
<html>
<head>
    <?php require 'include/meta.php'; ?>
    <title>Gato</title>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/signup.css" />
</head>
<body>
    <div id="container">
            <img src="assets/images/logo/hop_github_logo.svg" alt="logo" id="body__container__logo">
        <div id="div__container__tekst">
            <h1>Registration</h1>
        </div>
        <form>
        <input type="text" name="Mail" placeholder="Email" class="div__container__info">
        <input type="text" name="Full Name" placeholder="Full Name" class="div__container__info">
        <input type="text" name="Username" placeholder="Username" class="div__container__info">
        <input type="text" name="Password" placeholder="Password" class="div__container__info">
        </form>
        <input type="button" class="button" value="Register">
    </div>
</body>
</html>