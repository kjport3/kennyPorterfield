<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/home_navigation.php"; // Homepage Navigation
?>

    <section class="section-about js--section-about" id="about">
        <div class="row">
            <img src='../resources/img/profile-pic.jpg' alt='Kenny Porterfield' class='profile-pic'>
        </div>
        <div class="row">
            <h2>About me</h2>
            <p class="long-copy">
                Hello! My name is Kenny Porterfield and I am a web developer living in Atlanta, Georgia. I like to
                spend my time running, reading, learning, and growing as a developer. Fun facts about me: I have run an
                average of over 2,000 miles a year for the last 5 years. In 2014 I thru-hiked the 2,200 miles of
                the Appalachian Trail over 4 months. I read 70 books last year. And I am currently a Senior Campaign
                Developer at Digital Additive. I have found that writing about the things I'm learning forces me to
                slow down, lets the ideas take root, and helps them stick with me. In addition to sharing
                things I'm learning, I plan to write some blogs on life stuff.<br>
<!--                <a href="about.php">More about me<i class="fa fa-fw fa-angle-double-right"></i></a>-->
                <br><br>
            </p>
        </div>
        <div class="row">
            <div class="col span-1-of-2 about-container">
                <ul class="social-links about-links">
                    <li><a href="https://www.github.com/kjport3" title="Github" target="_blank"><i class="ion-social-github"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/kenporterfield/" title="LinkedIn" target="_blank"><i class="ion-social-linkedin"></i></a></li>
                    <li><a href="./rss.xml" title="Subscribe via RSS" target="_blank"><i class="ion-social-rss"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-btn inactive-link" title="More..."><i class="ion-ios-more"></i> </a>
                        <ul class="dropdown-content-inline">
                            <li class="inline-dropdown-first">
                                <a href="https://gist.github.com/kjport3" title="Github Gists" target="_blank"><i class="ion-ios-gear"></i></a>
                            </li>
                            <li class="inline-dropdown">
                                <a href="https://www.instagram.com/kenny_yom/" title="Instagram" target="_blank"><i class="ion-social-instagram"></i></a>
                            </li>
                            <li class="inline-dropdown mob-icon-row">
                                <a href="https://www.goodreads.com/user/show/28192247-kenny-porterfield" title="Goodreads" target="_blank"><i class="ion-ios-book"></i></a>
                            </li>
                            <li class="inline-dropdown">
                                <a href="https://www.strava.com/athletes/4032470" title="Strava" target="_blank"><i class="ion-android-walk"></i></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>
