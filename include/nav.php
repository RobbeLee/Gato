<!--
    Mike - 12/03/19

    Af blijven
-->

<?php
$path = "assets/userfiles/pfp/default.webp";
if (isset($_SESSION['id'])) $path = "assets/userfiles/pfp/".$_SESSION['id'].".webp";
if ($subFolder) $path = "../".$path;
if (file_exists($path)) {
    $pfp = $path;
} else {
    $pfp = "assets/userfiles/pfp/default.webp";
    if ($subFolder) $pfp = "../".$pfp;
}
?>
<nav>
    <div class="nav__left-container">
        <a href="<?php if ($subFolder) echo "."; ?>./" class="nav__title" title="<?=$_BRAND; ?>"><?=$_BRAND; ?></a>
        <a href="<?php if ($subFolder) echo "."; ?>./" title="Home" class="nav__link">home</a>
        <a href="<?php if ($subFolder) echo "../"; ?>about" title="About" class="nav__link">about</a>
    </div>
    <div class="nav__right-container">
    <form class="nav__form" action="<?php if ($subFolder) echo "."; ?>./search" method="get">
        <input class="nav__input" type="text" name="q" value="<?php if ($_PAGE == "search") echo htmlspecialchars($_GET['q']); ?>" placeholder="Search" title="Search" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none"/>
        <button type="submit" title="Search" class="nav__search-btn">
            <svg viewBox="0 0 18 18"><path d="m 9.3962688,9.5396955 3.1875032,3.1165125 4.685825,4.581467 Z M 10.126225,9.276927 C 10.957192,8.2289874 11.351645,6.8454225 11.198222,5.5168348 11.044799,4.188247 10.345391,2.930999 9.2974515,2.1000317 8.249512,1.2690645 6.8659471,0.87461216 5.5373593,1.0280348 4.2087716,1.1814574 2.9515235,1.8808656 2.1205563,2.9288052 1.2895891,3.9767448 0.89513671,5.3603097 1.0485594,6.6888974 1.201982,8.0174852 1.9013902,9.2747332 2.9493298,10.1057 c 1.0479395,0.830968 2.4315044,1.22542 3.7600922,1.071997 1.3285877,-0.153422 2.5858358,-0.85283 3.416803,-1.90077 z" /></svg>
        </button>
    </form>
    <?php if (isset($_SESSION['id'])): ?>
        <button class="nav__btn" id="new_post" title="New Post"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM17 11h-4v4h-2v-4H7V9h4V5h2v4h4v2z"/></svg></button>
        <button class="nav__btn" id="notifications-toggle" title="Notifications"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg></button>
        <button class="nav__pfp-container" id="pfp-toggle" title="<?=htmlspecialchars($_SESSION['name']);?>">
            <img src="<?=htmlspecialchars($pfp)?>" alt="error" class="nav__pfp">
        </button>
    <?php else: ?>
        <a href="<?php if ($subFolder) echo "../"; ?>login" title="Login" class="nav__login-btn">login</a>
        <a href="<?php if ($subFolder) echo "../"; ?>signup" title="Sign Up" class="nav__signup-btn">sign up</a>
    <?php endif; ?>            
    </div>
    <div class="nav__hamburger">
        <input type="checkbox" id="nav-toggle" style="display:none;"/>
        <label class="nav__ham-toggle" for="nav-toggle">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </label>
        <div class="nav-links-container">
            <form class="nav__form" style="margin: 0;" action="<?php if ($subFolder) echo "../"; ?>search" method="get">
                <input class="nav__input" type="text" name="q" placeholder="Search" title="Search" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none"/>
                <button type="submit" class="nav__search-btn">
                    <svg viewBox="0 0 18 18"><path d="m 9.3962688,9.5396955 3.1875032,3.1165125 4.685825,4.581467 Z M 10.126225,9.276927 C 10.957192,8.2289874 11.351645,6.8454225 11.198222,5.5168348 11.044799,4.188247 10.345391,2.930999 9.2974515,2.1000317 8.249512,1.2690645 6.8659471,0.87461216 5.5373593,1.0280348 4.2087716,1.1814574 2.9515235,1.8808656 2.1205563,2.9288052 1.2895891,3.9767448 0.89513671,5.3603097 1.0485594,6.6888974 1.201982,8.0174852 1.9013902,9.2747332 2.9493298,10.1057 c 1.0479395,0.830968 2.4315044,1.22542 3.7600922,1.071997 1.3285877,-0.153422 2.5858358,-0.85283 3.416803,-1.90077 z" /></svg>
                </button>
            </form>
            <a href="<?php if ($subFolder) echo "."; ?>./" title="Home" class="nav-link">home</a>
            <a href="<?php if ($subFolder) echo "../"; ?>about" title="About" class="nav-link">about</a>
                <?php if (isset($_SESSION['id'])): ?>
                    <span class="nav-linkmy" id="myaccount">My Account</span>
                        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>" title="My Profile" class="nav-link__acount">- my profile</a>
                        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>#posts" title="My Posts" class="nav-link__acount">- my posts</a>
                        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>#liked" title="Liked Posts" class="nav-link__acount">- liked posts</a>
                        <a href="<?php if ($subFolder) echo "../"; ?>account/settings" title="Settings" class="nav-link__acount">- settings</a>
                        <a href="<?php if ($subFolder) echo "../"; ?>logout" title="Sign Out" class="nav-link__acount">- sign out</a>
            <?php else: ?>
                <a href="<?php if ($subFolder) echo "../"; ?>login" title="Login" class="nav-link">login</a>
                <a href="<?php if ($subFolder) echo "../"; ?>signup" title="Sign Up" class="nav-link">sign up</a>
            <?php endif; ?>            
        </div>
    </div>
</nav>

<?php if (isset($_SESSION['id'])): ?>
<div class="notifications">
<?php
$stmt = $conn->prepare("SELECT * FROM friends WHERE friendid=?;");
$stmt->execute([$_SESSION['id']]);
$notifications = $stmt->fetchAll();
if ($stmt->rowCount() == 0) echo "No new notifications.";
foreach ($notifications as $notification):
    $stmt = $conn->prepare("SELECT username FROM users WHERE id=?;");
    $stmt->execute([$notification['uid']]);
    $newFriend = $stmt->fetch();
?>
    <a href="<?php if ($subFolder) echo "../"; ?>u/<?=strtolower(htmlspecialchars($newFriend['username']))?>" class="notification">
        <span class="notification__username">@<?=htmlspecialchars($newFriend['username'])?></span> has befriended you
    </a>
<?php endforeach; ?>
</div>

<div class="user-nav" id="user-nav">
    <div class="user-nav__info">
        <h2 class="user-nav__username" title="@<?=htmlspecialchars($_SESSION['username']); ?>">@<?=htmlspecialchars($_SESSION['username']); ?></h2>
        <span class="user-nav__email" title="<?=htmlspecialchars($_SESSION['email']); ?>"><?=htmlspecialchars($_SESSION['email']); ?></span>
    </div>
    <div class="user-nav__body">
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>" title="My Profile" class="user-nav__link <?php if ($_PAGE == "profile" && $user == strtolower($_SESSION['username'])) echo "user-nav__link--active"; ?>"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="user-nav__link-span">my profile</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>#liked" title="Liked Posts" class="user-nav__link user-nav__profile-liked"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg><span class="user-nav__link-span">liked posts</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?php echo strtolower(htmlspecialchars($_SESSION['username'])); ?>#friends" title="My Friends" class="user-nav__link user-nav__profile-friends"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg><span class="user-nav__link-span">my friends</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>account/settings" title="Settings" class="user-nav__link <?php if ($_PAGE == "settings") echo "user-nav__link--active"; ?>"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M15.95 10.78c.03-.25.05-.51.05-.78s-.02-.53-.06-.78l1.69-1.32c.15-.12.19-.34.1-.51l-1.6-2.77c-.1-.18-.31-.24-.49-.18l-1.99.8c-.42-.32-.86-.58-1.35-.78L12 2.34c-.03-.2-.2-.34-.4-.34H8.4c-.2 0-.36.14-.39.34l-.3 2.12c-.49.2-.94.47-1.35.78l-1.99-.8c-.18-.07-.39 0-.49.18l-1.6 2.77c-.1.18-.06.39.1.51l1.69 1.32c-.04.25-.07.52-.07.78s.02.53.06.78L2.37 12.1c-.15.12-.19.34-.1.51l1.6 2.77c.1.18.31.24.49.18l1.99-.8c.42.32.86.58 1.35.78l.3 2.12c.04.2.2.34.4.34h3.2c.2 0 .37-.14.39-.34l.3-2.12c.49-.2.94-.47 1.35-.78l1.99.8c.18.07.39 0 .49-.18l1.6-2.77c.1-.18.06-.39-.1-.51l-1.67-1.32zM10 13c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z"/></svg><span class="user-nav__link-span">settings</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>logout" title="Sign Out" class="user-nav__link"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg><span class="user-nav__link-span">sign out</span></a>
    </div>
</div>
<script>
    let open = false;
    document.querySelector('#notifications-toggle').addEventListener('click', () => {
        userNavOpen ? document.querySelector('.notifications').style.transform = "translateX(550px)" : document.querySelector('.notifications').style.transform = "translateX(0)";
        userNavOpen ? userNavOpen = false : userNavOpen = true;
    });
</script>
<script>
    let userNavOpen = false;
    document.querySelector('#pfp-toggle').addEventListener('click', () => {
        userNavOpen ? document.querySelector('#user-nav').style.transform = "translateX(400px)" : document.querySelector('#user-nav').style.transform = "translateX(0)";
        userNavOpen ? userNavOpen = false : userNavOpen = true;
    });
</script>
<?php endif; ?>