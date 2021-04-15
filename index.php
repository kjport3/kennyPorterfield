<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/home_navigation.php"; // Homepage Navigation
?>

    <section class="section-about js--section-about" id="about">
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
    </section>

<?php include "includes/blog_showcase.php"; ?>

<?php include "includes/contact.php"; ?>

<?php include "includes/footer.php"; ?>