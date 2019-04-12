<div id="myModal" style="display:none;">
    <div id="form-container">
        <div id="modal" class="form">
            <span class="form__close">&times;</span>
            <form enctype="multipart/form-data" method="GET" action="<?php if ($subFolder) echo "../"; ?>api/post/makePost.php">
            <div class="form__text">
                <div class="form__border">
                <h1 class="form__title"> What do you want to post today? </h1>
            </div>
                <div class="form__content">
                    <h2 class="form__content__title"> Content </h2>
                    <input type="text-area" class="form__content__input" placeholder="What is on your mind?">
                </div>
                <div class="form__button__bottom">
                <input type="file" name="file" id="file" style="display:none;" class="file__input">
                <label for="file" class="file__label">Search Picture</label>
                <input type="submit" name-="submit" id="submit" style="display:none" value="Submit">
                <label for="submit" class="file__label">Submit</label>
              </div>
            </form>
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