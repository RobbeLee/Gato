<div class="view-post-container">
    <div class="view-post">
        <div class="view-post__img-container">
            <img src="assets/userfiles/imgs/5cba1a6429e7e5.20487861.webp" alt="error" class="view-post__img">
        </div>
        <div class="view-post__body">
            <div class="view-post__header">
                <a class="view-post__pfp-container">
                    <img src="assets/userfiles/pfp/default.webp" alt="" class="view-post__pfp">
                </a>
                <div class="view-post__user-info">
                    <a class="view-post__name">jeff jeffington</a>
                    <a class="view-post__username">@my_name_jeffe_420</a>
                </div>
            </div>
            <div class="view-post__content-container">
                <p class="view-post__content">This post is going to have so much text that people won't even bother reading it. If you are reading it then you're gay lol. Now time for the big epic</p>
            </div>
        </div>
        <button class="post__like-btn view-post__like-btn" data-id=""><svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></button>
        <button class="view-post__close">X</button>
    </div>
</div>

<script>
let allPosts = document.querySelectorAll(".post");
Array.prototype.forEach.call(allPosts, post => {
    post.addEventListener('click', e => {
        console.log(post.children);
        if (e.target == post.children[3] || e.target == post.children[3].children[0] || e.target == post.children[3].children[0].children[0]) return;
        document.querySelector(".view-post-container").style.display = "flex";
        let postChildren = post.children;
        if (postChildren[0].childNodes.length == 1) {
            document.querySelector(".view-post__img-container").style.display = "none";
            document.querySelector(".view-post__body").style.width = "100%";
        } else {
            document.querySelector(".view-post__img-container").style.display = "flex";
            document.querySelector(".view-post__body").style.width = "calc((100% - 50%) - 20px)";
            document.querySelector(".view-post__img").src = postChildren[0].children[0].src;
        }
        document.querySelector('.view-post__pfp-container').href = postChildren[2].children[0].href;
        document.querySelector(".view-post__pfp").src = postChildren[2].children[0].children[0].src;
        document.querySelector(".view-post__name").innerHTML = postChildren[2].children[1].children[0].children[0].innerText;
        document.querySelector('.view-post__name').href = postChildren[2].children[0].href;
        document.querySelector('.view-post__username').href = postChildren[2].children[0].href;
        document.querySelector(".view-post__username").innerHTML = postChildren[2].children[1].children[0].children[1].innerText;
        document.querySelector(".view-post__content").innerHTML = postChildren[1].innerText;
        document.querySelector('.view-post__like-btn').dataset.id = postChildren[3].dataset.id;
        if (postChildren[3].dataset.liked == 0) {
            document.querySelector('.view-post__like-btn').classList.remove("post__like-btn--liked");
        } else {
            document.querySelector('.view-post__like-btn').classList.add("post__like-btn--liked");
        }
    });
});
document.querySelector(".view-post__close").addEventListener('click', () => {
    document.querySelector(".view-post-container").style.display = "none";
});
</script>