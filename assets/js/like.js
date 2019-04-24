let likeBtns = document.querySelectorAll('.post__like-btn');

Array.prototype.forEach.call(likeBtns, b => {
    b.addEventListener('click', () => {
        likePost(b.dataset.id, b);
    });
});

function likePost(postID, btn) {
    if (postID == '') return;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let liked = this.responseText;
            console.log(liked);
            if (liked == 1) {
                btn.classList.add("post__like-btn--liked");
            } else if (liked == 0) {
                btn.classList.remove("post__like-btn--liked");
            }
        }
    };
    let url = "/api/post/like.php?postID="+postID;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}