<!--
    Mike - 12/03/19

    Af blijven
-->

<nav>
    <div class="nav__left-container">
        <h1 class="nav__title" title="<?=$_BRAND; ?>"><?=$_BRAND; ?></h1>
        <a href="<?php if ($subFolder) echo "."; ?>./" title="Home" class="nav__link">home</a>
        <a href="<?php if ($subFolder) echo "../"; ?>about" title="About" class="nav__link">about</a>
    </div>
    <?php if (isset($_SESSION['id'])): ?>
    <div class="nav__right-container">
        <form class="nav__form" action="<?php if ($subFolder) echo "../"; ?>search" method="get">
            <input class="nav__input" type="text" name="q" placeholder="Search" title="Search" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none"/>
            <button type="submit" title="Search" class="nav__search-btn">
                <svg viewBox="0 0 18 18"><path d="m 9.3962688,9.5396955 3.1875032,3.1165125 4.685825,4.581467 Z M 10.126225,9.276927 C 10.957192,8.2289874 11.351645,6.8454225 11.198222,5.5168348 11.044799,4.188247 10.345391,2.930999 9.2974515,2.1000317 8.249512,1.2690645 6.8659471,0.87461216 5.5373593,1.0280348 4.2087716,1.1814574 2.9515235,1.8808656 2.1205563,2.9288052 1.2895891,3.9767448 0.89513671,5.3603097 1.0485594,6.6888974 1.201982,8.0174852 1.9013902,9.2747332 2.9493298,10.1057 c 1.0479395,0.830968 2.4315044,1.22542 3.7600922,1.071997 1.3285877,-0.153422 2.5858358,-0.85283 3.416803,-1.90077 z" /></svg>
            </button>
        </form>
        <button class="nav__btn" title="New Post"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM17 11h-4v4h-2v-4H7V9h4V5h2v4h4v2z"/></svg></button>
        <button class="nav__btn" title="Notifications"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg></button>
        <button class="nav__pfp-container" id="pfp-toggle" title="<?=$_SESSION['name'];?>">
            <img src="<?php if ($subFolder) echo "../"; ?>assets/userfiles/pfp/<?php //$_SESSION['id']; ?>default.webp" alt="error" class="nav__pfp">
        </button>
    </div>
    <?php else: ?>
    <div class="nav__right-container">
        <form class="nav__form" action="<?php if ($subFolder) echo "../"; ?>search" method="get">
            <input class="nav__input" type="text" name="q" placeholder="Search" title="Search" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none"/>
            <button type="submit" class="nav__search-btn">
                <svg viewBox="0 0 18 18"><path d="m 9.3962688,9.5396955 3.1875032,3.1165125 4.685825,4.581467 Z M 10.126225,9.276927 C 10.957192,8.2289874 11.351645,6.8454225 11.198222,5.5168348 11.044799,4.188247 10.345391,2.930999 9.2974515,2.1000317 8.249512,1.2690645 6.8659471,0.87461216 5.5373593,1.0280348 4.2087716,1.1814574 2.9515235,1.8808656 2.1205563,2.9288052 1.2895891,3.9767448 0.89513671,5.3603097 1.0485594,6.6888974 1.201982,8.0174852 1.9013902,9.2747332 2.9493298,10.1057 c 1.0479395,0.830968 2.4315044,1.22542 3.7600922,1.071997 1.3285877,-0.153422 2.5858358,-0.85283 3.416803,-1.90077 z" /></svg>
            </button>
        </form>
        <a href="<?php if ($subFolder) echo "../"; ?>login" title="Login" class="nav__login-btn">login</a>
        <a href="<?php if ($subFolder) echo "../"; ?>signup" title="Sign Up" class="nav__signup-btn">sign up</a>
    </div>
    <?php endif; ?>
</nav>

<?php if (isset($_SESSION['id'])): ?>
<div class="user-nav" id="user-nav">
    <div class="user-nav__info">
        <h2 class="user-nav__username" title="@<?=$_SESSION['username']; ?>">@<?=$_SESSION['username']; ?></h2>
        <span class="user-nav__email" title="<?=$_SESSION['email']; ?>"><?=$_SESSION['email']; ?></span>
    </div>
    <div class="user-nav__body">
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?=$_SESSION['username']; ?>" title="My Profile" class="user-nav__link"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="user-nav__link-span">my profile</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?=$_SESSION['username']; ?>" title="My Posts" class="user-nav__link"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z"/></svg><span class="user-nav__link-span">my posts</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>u/<?=$_SESSION['username']; ?>/liked" title="Liked Posts" class="user-nav__link"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg><span class="user-nav__link-span">liked posts</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>account/settings" title="Settings" class="user-nav__link"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M15.95 10.78c.03-.25.05-.51.05-.78s-.02-.53-.06-.78l1.69-1.32c.15-.12.19-.34.1-.51l-1.6-2.77c-.1-.18-.31-.24-.49-.18l-1.99.8c-.42-.32-.86-.58-1.35-.78L12 2.34c-.03-.2-.2-.34-.4-.34H8.4c-.2 0-.36.14-.39.34l-.3 2.12c-.49.2-.94.47-1.35.78l-1.99-.8c-.18-.07-.39 0-.49.18l-1.6 2.77c-.1.18-.06.39.1.51l1.69 1.32c-.04.25-.07.52-.07.78s.02.53.06.78L2.37 12.1c-.15.12-.19.34-.1.51l1.6 2.77c.1.18.31.24.49.18l1.99-.8c.42.32.86.58 1.35.78l.3 2.12c.04.2.2.34.4.34h3.2c.2 0 .37-.14.39-.34l.3-2.12c.49-.2.94-.47 1.35-.78l1.99.8c.18.07.39 0 .49-.18l1.6-2.77c.1-.18.06-.39-.1-.51l-1.67-1.32zM10 13c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z"/></svg><span class="user-nav__link-span">settings</span></a>
        <a href="<?php if ($subFolder) echo "../"; ?>logout" title="Sign Out" class="user-nav__link"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg><span class="user-nav__link-span">sign out</span></a>
    </div>
</div>
<?php endif; ?>
<script>
    let open = false;
    document.querySelector('#pfp-toggle').addEventListener('click', () => {
        if (open) {
            open = false;
            document.querySelector('#user-nav').style.transform = "translateX(400px)";
        } else {
            open = true;
            document.querySelector('#user-nav').style.transform = "translateX(0)";
        }
    })
</script>