<!--<div id="myModal" style="display:none;">
    <div id="form-container">
        <div id="modal" class="form">
            <span class="form__close">X</span>
                 <form enctype="multipart/form-data" method="post" action="api/post/makePost.php">
            <div class="form__text">
                <div class="form__border">
                    <h1 class="form__title"> What do you want to post today? </h1>
                </div>
                <div class="form__content">
                    <textarea type="text" name="msg" class="form__content__input" placeholder="What is on your mind?" id="content"></textarea>
                </div>
                <div class="form__button__bottom">
                    <input type="file" name="file" id="file" style="display:none;"/>
                    <label for="file" class="form__button__label">Upload Picture</label>
                    <button type="submit" name="submit" class="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="postmodal" id="postmodal" style="display:none;">
    <form action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php" enctype="multipart/form-data" method="post" class="postmodal__form">
        <span class="postmodal__close" id="postmodal__close">X</span>
        <h2 class="postmodal__title">What do you want to post today?</h2>
        <div class="postmodal__input-container">
            <textarea class="postmodal__textarea" name="msg" placeholder="Message..."></textarea>
            <div class="input-underline"></div>
        </div>
        <div class="postmodal__footer">
            <input type="file" name="file" id="file" style="display:none;">
            <label for="file" class="postmodal__label">Upload Picture</label>
            <button type="submit" name="submit" class="postmodal__btn" id="postmodal__btn">post</button>
        </div>
    </form>
</div>

<script> 
    //new_post
    //ik hoop dat iemand me uit mijn lijden verlost.
    let postmodal = document.querySelector('#postmodal'),
        makepostbtn = document.querySelector("#new_post"),
        postspan = document.querySelector("#postmodal__close"),
        postmodalOpen = false;

    makepostbtn.addEventListener('click', () => {
        postmodalOpen ? postmodal.style.display = "none" : postmodal.style.display = "flex";
        postmodalOpen ? postmodalOpen = false : postmodalOpen = true;
    });
    postspan.addEventListener('click', ()=>{
        postmodalOpen ? postmodal.style.display = "none" : postmodal.style.display = "flex";
        postmodalOpen ? postmodalOpen = false : postmodalOpen = true;
    })
</script> 