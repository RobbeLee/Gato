<nav>
    <div class="nav__left-container">
        <h1 class="nav__title" title="Gato">gato</h1>
        <a href="./" class="nav__link">home</a>
        <a href="./about" class="nav__link">about</a>
    </div>
    <div class="nav__right-container">
        <form class="nav__form" action="./search" method="get">
            <input class="nav__input" type="text" name="q" placeholder="Search" title="Search" autocomplete="off" autocorrect="off" spellcheck="false" autocapitalize="none"/>
            <button type="submit" class="nav__search-btn">
                <svg viewBox="0 0 18 18"><path d="m 9.3962688,9.5396955 3.1875032,3.1165125 4.685825,4.581467 Z M 10.126225,9.276927 C 10.957192,8.2289874 11.351645,6.8454225 11.198222,5.5168348 11.044799,4.188247 10.345391,2.930999 9.2974515,2.1000317 8.249512,1.2690645 6.8659471,0.87461216 5.5373593,1.0280348 4.2087716,1.1814574 2.9515235,1.8808656 2.1205563,2.9288052 1.2895891,3.9767448 0.89513671,5.3603097 1.0485594,6.6888974 1.201982,8.0174852 1.9013902,9.2747332 2.9493298,10.1057 c 1.0479395,0.830968 2.4315044,1.22542 3.7600922,1.071997 1.3285877,-0.153422 2.5858358,-0.85283 3.416803,-1.90077 z" /></svg>
            </button>
        </form>
        <button class="nav__btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM17 11h-4v4h-2v-4H7V9h4V5h2v4h4v2z"/></svg></button>
        <button class="nav__btn"><svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg></button>
        <button class="nav__pfp-container">
            <img src="./assets/userfiles/pfp/<?php // Need unique ID here ?>default.webp" alt="error" class="nav__pfp">
        </button>
    </div>
</nav>