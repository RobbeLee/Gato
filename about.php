<?php
    require 'include/php_header.php';
    $subFolder = false;
    $_TITLE = "About | ".$_BRAND;
    $_PAGE = "about";
?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'include/meta.php'; ?>
</head>
<body>
    <?php require 'include/nav.php'; ?>
    <div class="wrapper">
        <div class="section about">
         <h1 class="about__title"> About GATO </h1>
         <p class="section__p"> With this page we hope to explain to you who we are, what we do, 
             what this site is and what we hope to achieve. </p>
        </div>
        <div class="section site section--colour">
            <h2 class="section__title">What is this site?</h2>
            <p class="section__p">With Gato we hope to build a site that's easy to navigate and use. We see many social media platforms
                That are just impossible to use. <br>They are busy and often have annoying popups. Here at Gato we see this
                and get a little frustrated about it, we will offer you a place where you just come to share a photo and
                look at the photo's of your friends.<br> Nothing more, nothing less. This way we can offer you minimalistic design
                that is easy to use and navigate.</p> 
        </div>
        <div class="section who">
            <h2 class="section__title"> Who are we </h2>
            <p class="section__p">Our names are Matthijs, Mike and Robbe. 
                We are three Dutch students, who do a mediadevelopment course. <br>
                During this course we get several assigments and this is one of them.</p>
            <div class="names">
                <div class="card">
                    <img src="assets/userfiles/pfp/default.webp" alt="Matthijs's face" class="card__img">
                    <h3 class="card__title">Matthijs</h3>
                    <p class="card__p"><i>stukje over mij</i></p> 
                    <a href="https://github.com/263782" target="_blank" class="card__link">Github</a>
                </div>
                <div class="card">
                    <img src="assets/userfiles/pfp/default.webp" alt="Matthijs's face" class="card__img">   
                    <h3 class="card__title">Mike</h3>
                    <p class="card__p"><b><i>nee</i></b></p>
                    <a href="https://github.com/MikeS25933" target="_blank" class="card__link">Github</a>

                </div>
                <div class="card">
                    <img src="assets/userfiles/pfp/default.webp" alt="Matthijs's face" class="card__img">
                    <h3 class="card__title">Robbe</h3>
                    <p class="card__p">Hi my name is Robbe and I am a 16 year old student from the Netherlands.
                        I did all of the documentation and this about page for our project.</p>
                    <a href="https://github.com/RobbeLee" target="_blank" class="card__link">Github</a>
                </div>            
            </div>
        </div>
        <div class="section what section--colour">
            <h2 class="section__title"> What we do</h2>
            <p class="section__p">As said earlier, we are still students. We currently study mediadevelopment at MediaCollege Amsterdam.<br>
                This is a three year course in which we will have to do many projects, this so happens to be one of them.<br>
                Over the three years we will make a ton of project so if you want to see the rest, take a look at 
                our GitHub links.<br></p>
        </div>
        <div class="section achieve">
            <h2 class="section__title">What we hope to achieve</h2>
            <p class="section__p">We hope that we can offer you a platform where you can share your photo's easy and fast.<br>
                We can only do this with your feedback tho so if you have any issues or remarks please contact us.
                </p>
        </div>
    </div>
</body>
</html>