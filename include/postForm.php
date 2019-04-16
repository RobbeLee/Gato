<div id="myModal" style="display:none;">
    <div id="form-container">
        <div id="modal" class="form">
            <span class="form__close">&times;</span>
                 <form enctype="multipart/form-data" method="post" action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php">
            <div class="form__text">
                <div class="form__border">
                    <h1 class="form__title"> What do you want to post today? </h1>
                </div>
                <div class="form__content">
                    <input type="text-area" name="msg" class="form__content__input" placeholder="What is on your mind?" id="content">
                </div>
                <div class="form__button__bottom">
                    <input type="file" name="file" id="file" class="file__label"/>
                    <button type="submit" name="submit" class="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- schermvullend, rgba 0,0,0, .4/.6, achtergrond wit -->
<script> 
    //new_post
    //ik hoop dat iemand me uit mijn lijden verlost.
    let modal = document.querySelector('#myModal'),
        btn = document.querySelector("#new_post"),
        span = document.querySelector(".form__close"),
        openModal = false;

    btn.addEventListener('click', () => {
        openModal ? modal.style.display = "none" : modal.style.display = "flex";
        openModal ? openModal = false : openModal = true;
    });
    span.addEventListener('click', ()=>{
        openModal ? modal.style.display = "none" : modal.style.display = "flex";
        openModal ? openModal = false : openModal = true;
    })
</script> 