<?php
require '../include/db.php';
require '../include/php_header.php';
require '../include/langs.php';
require '../include/countries.php';
$subFolder = true;
$_TITLE = "Settings | ".$_BRAND;
$_PAGE = "settings";

if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit;
}

/*
    Mike - 23/03/19 - Get the country and language from database.
    Then in both loops check for those 2 and if they match make them have the selected attribute
*/

//$stmt = $conn->prepare("SELECT country")
?>

<!DOCTYPE html>
<html>
<head>
    <?php require '../include/meta.php'; ?>
</head>
<body>
    <?php require '../include/nav.php'; ?>
    <div class="container">
        <div class="settings-nav">
            <a class="settings-nav__link settings-nav__link--active" data-page="account">account</a>
            <a class="settings-nav__link" data-page="password">password</a>
            <a class="settings-nav__link" data-page="content">content</a>
        </div>
        <div class="settings-body">
            <div class="settings-container" style="display: flex;" id="account">
                <h2 class="settings__title">account</h2>
                <form action="../api/settings/account.php" method="post" class="settings__form" enctype="multipart/form-data">
                    <div class="settings__input-container">
                        <input type="text" name="name" id="name" title="Name" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="name">name</label>
                        <div class="input__underline"></div>
                    </div>
                    <div class="settings__input-container">
                        <input type="text" name="username" id="username" title="Username" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="username">username</label>
                        <div class="input__underline"></div>
                    </div>
                    <div class="settings__input-container">
                        <input type="email" name="email" id="email" title="Email" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="email">email</label>
                        <div class="input__underline"></div>
                    </div>
                    <div class="settings__input-container">
                        <input type="file" name="file" id="file" style="display:none;" class="file__input">
                        <label for="file" class="file__label">Upload Profile Picture</label>
                        <span id="pfp-input-value" class="pfp-input-value"></span>
                    </div>
                    <button type="submit" name="submit" class="settings__btn">save</button>
                </form>
            </div>
            <div class="settings-container" id="password">
                <h2 class="settings__title">password</h2>
                <form action="../api/settings/password.php" method="post" class="settings__form">
                    <div class="settings__input-container">
                        <input type="password" name="old-password" title="Old Password" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="name">old password</label>
                        <div class="input__underline"></div>
                    </div>
                    <div class="settings__input-container" style="margin-top:80px;">
                        <input type="password" name="new-password" title="New Password" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="username">new password</label>
                        <div class="input__underline"></div>
                    </div>
                    <div class="settings__input-container">
                        <input type="password" name="repeat-password" title="Repeat Password" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none" class="settings__input">
                        <label class="input__label" for="email">repeat password</label>
                        <div class="input__underline"></div>
                    </div>
                    <button type="submit" name="submit" class="settings__btn">save</button>
                </form>

            </div>
            <div class="settings-container" id="content">
                <h2 class="settings__title">content</h2>
                    <div class="settings__input-container">
                        <select name="country" id="country" class="select-input">
                            <?php foreach ($_COUNTRIES as $country): ?>
                            <option value="<?=strtolower($country['code'])?>"><?=$country['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="settings__btn">save</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        let account = document.querySelector('#account'),
              content = document.querySelector('#content'),
              password = document.querySelector('#password'),
              links = document.getElementsByClassName('settings-nav__link'),
              inputs = document.getElementsByClassName('settings__input');

        Array.prototype.forEach.call(links, (link) => {
            link.addEventListener('click', () => {
                let page = link.dataset.page;
                if (page == "account") {
                    content.style.display = "none";
                    password.style.display = "none";
                    account.style.display = "flex";
                    Array.prototype.forEach.call(links, (link) => {
                        link.classList.remove('settings-nav__link--active');
                    });
                    link.classList.add('settings-nav__link--active');
                }
                else if (page == "password") {
                    content.style.display = "none";
                    account.style.display = "none";
                    password.style.display = "flex";
                    Array.prototype.forEach.call(links, (link) => {
                        link.classList.remove('settings-nav__link--active');
                    });
                    link.classList.add('settings-nav__link--active');
                }
                else if (page == "content") {
                    password.style.display = "none";
                    account.style.display = "none";
                    content.style.display = "flex";
                    Array.prototype.forEach.call(links, (link) => {
                        link.classList.remove('settings-nav__link--active');
                    });
                    link.classList.add('settings-nav__link--active');
                }
            });
        });
        
        Array.prototype.forEach.call(inputs, (input) => {
            input.addEventListener('blur', () => {
                (input.value) ? input.classList.add('has-value') : input.classList.remove('has-value');
            });
        });
    </script>
</body>
</html>