<?php
include "includes/db.php"; // DB Connection

include "includes/header.php"; // Header

include "includes/navigation.php"; // Site Navigation
?>
        <br><br>
        <section class="section-about" id="about">
            <div class="row">
                <h2>Thanks</h2>
                <p class="long-copy">
                    Your message has been sent.<br>I'll get back in touch with you soon!
                    <br><br>
                    Here are some recent blog posts you can check out:
                </p>
            </div>
        </section>

        <?php include "includes/blog_showcase.php"; ?>
<br><br><br><br>

<?php include "includes/footer.php"; ?>