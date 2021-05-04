<section class="section-form js--section-contact" id="contact">
    <div class="row">
        <h2>Get in touch</h2>
        <p>Kenny Porterfield<br><a href="mailto:kjport3@gmail.com">kjport3@gmail.com</a><br><a href="https://www.linkedin.com/in/kenporterfield/" title="LinkedIn" target="_blank">LinkedIn</a><br><br>Or, send me a message from here:</p>
    </div>
    <div class="row">
        <form method="POST" action="contact-form-handler.php" class="contact-form">


            <div class="row">
                <div class="col span-1-of-3">
                    <label for="name">Name</label>
                </div>
                <div class="col span-3-of-3">
                    <input type="text" name="name" id="name" placeholder="Your name" required>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="email">Email</label>
                </div>
                <div class="col span-3-of-3">
                    <input type="email" name="email" id="email" placeholder="Your email" required>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label>Message</label>
                </div>
                <div class="col span-3-of-3">
                    <textarea name="message" placeholder=""></textarea>
                </div>
            </div>
            <!-- reCAPTCHA -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <div class="row">
                <div class="col span-2-of-3">
                    <div class="g-recaptcha" data-sitekey="6LdrWbIaAAAAAE2K1xOC9oLmFUGURDijLO62enva"></div>
                </div>
            </div>
            <?php
            if(!empty($_POST['g-recaptcha-response'])) {
                $secret = '6LdrWbIaAAAAAKm2Rvg_odsv8SwF0MhTMhZQq_XO';
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                if($responseData->success) {
                    echo "<input type='hidden' name='verification' value='success'>";
                } else {
                    echo "<input type='hidden' name='verification' value='fail'>";
                }
            }
            ?>

            <div class="row">
                <div class="col span-2-of-3">
                    <input type="submit" value="Send it!">
                </div>
            </div>
        </form>
    </div>
</section>