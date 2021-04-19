<?php session_start(); ?>
<div>
    <nav class="sticky">
        <div class="row">
            <a href="http://www.kennyporterfield.com"><img src="resources/img/kp-logo-black.png" alt="Kenny Porterfield"
                                                           class="logo-black"></a>
            <ul class="main-nav js--main-nav">
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="gogo-dev/gogorunning">Work</a></li> -->
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact" class="js--scroll-to-contact">Contact</a></li>
                <?php
                if (isset($_SESSION['user_role'])) {
                    $user_role = $_SESSION['user_role'];
                    ?>
                    <li>
                        <a href="includes/logout.php">Logout</a>
                    </li>
                <?php } ?>
                <?php
                if (!isset($_SESSION['user_role'])) {
                    $user_role = $_SESSION['user_role'];
                    ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                <?php } ?>
                <?php
                if (isset($_SESSION['user_role'])) {
                    $user_role = $_SESSION['user_role'];
                    if ($user_role == 'admin') {
                        ?>
                        <li>
                            <a href="admin">Admin</a>
                        </li>
                    <?php }
                } ?>
            </ul>
            <a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
        </div>
    </nav>

</div>