function getPosts(amount) {
    if (amount == '') return;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('#expand') = this.responseText;
        }
    };
    let url = "/gato/api/post/displayPosts.php?amount="+parseInt(amount);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

window.onscroll = ev => {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        getPosts(20);
    }
};