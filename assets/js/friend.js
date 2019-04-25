let followBtn = document.querySelector('.header__follow-btn');

followBtn.addEventListener('click', () => {
    friendUser(followBtn.dataset.id);
});

function friendUser(friendID) {
    if (friendID == '') return;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let friend = this.responseText;
            console.log(friend);
            if (friend == 1) {
                followBtn.classList.add("header__follow-btn--friend");
            } else if (friend == 0) {
                followBtn.classList.remove("header__follow-btn--friend");
            }
        }
    };
    let url = "/gato/api/account/friend.php?friendID="+friendID;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}