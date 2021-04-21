<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/home_navigation.php"; // Homepage Navigation
?>

    <section class="section-about js--section-about" id="about">
        <div class="row">
            <img src='../resources/img/Profile.JPG' alt='Kenny Porterfield' class='blog-hero'>
        </div>
        <div class="row">
            <h2>About me</h2>
            <p class="long-copy">
                Hi there! My name is Kenny Porterfield and I am a web developer living in Atlanta, Georgia. When I'm not
                busy coding, I like to spend my time running, reading, and learning. Fun facts: I have run an average of
                over 2,000 miles a year for the last 5 years, and before that in 2014 I thru-hiked the Appalachian
                Trail. I have read 61 books in the last year. And I am currently a Senior Email Developer at Digital
                Additive and am a Salesforce Certified Marketing Cloud Developer.
            </p>
        </div>
        <div class="row">
            <div class="col span-1-of-2 about-container">
                <ul class="social-links about-links">
                    <li><a href="https://www.github.com/kjport3" title="Github" target="_blank"><i class="ion-social-github"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/kenporterfield/" title="LinkedIn" target="_blank"><i class="ion-social-linkedin"></i></a></li>
                    <li><a href="https://www.instagram.com/kenny_yom/" title="Instagram" target="_blank"><i class="ion-social-instagram"></i></a></li>
                    <li><a href="https://www.strava.com/athletes/4032470" title="Strava" target="_blank"><i class="ion-android-walk"></i></a></li>
                </ul>
            </div>
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>