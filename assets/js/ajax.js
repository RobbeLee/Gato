let response, user;

function getPosts(q) {
    if (q == '') return;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.responseText);
            displayPosts(response);
        }
    };
    let url = "api/search/getPosts.php?q="+q;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function getUser(uid) {
    uid = parseInt(uid);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            user = JSON.parse(this.responseText);
            console.log('klaar');
        }
    };
    let url = "api/account/getUser.php?uid="+uid;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function displayPosts(posts) {
    let postsContainer = document.querySelector('.posts');

    posts.forEach(post => {
        let container = document.createElement('div'),
            content = document.createElement('p'),
            body = document.createElement('div'),
            userContainer = document.createElement('div'),
            inlineShit = document.createElement('div'),
            name = document.createElement('span'),
            username = document.createElement('span'),
            date = document.createElement('span');

            container.classList.add('post');
            content.classList.add('post__content');
            body.classList.add('post__body');
            userContainer.classList.add('post__user-container');
            name.classList.add('post__name');
            username.classList.add('post__username');
            date.classList.add('post__date');
            inlineShit.style.display = "flex"; inlineShit.style.flexDirection = "column";

        getUser(parseInt(post.uid));

        if (post.uniqueid !== null) {
            let userPfpContainer = document.createElement('div'),
                userPfp = document.createElement('img');
                userPfpContainer.classList.add('post__img-container');
                userPfp.classList.add('post__img');
        }
    });
}

let q = document.querySelector('.nav__input').value;
getPosts(q);