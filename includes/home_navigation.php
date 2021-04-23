<?php session_start(); ?>
<header>
    <nav>
        <div class="row">
            <img src="resources/img/kp-logo-white.png" alt="Kenny Porterfield" class="logo">
            <a href="#top"><img src="resources/img/kp-logo-black.png" alt="Kenny Porterfield" class="logo-black"></a>
            <ul class="main-nav js--main-nav">
                <li><a href="#top">Home</a></li>
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
    <div class="hero-text-box">
        <h1>Kenny Porterfield</h1>
        <h3 class="hero-text">Web dev. Learning. Running.<br></h3>
        <a class="btn btn-full js--scroll-to-about" href="#about">About Me</a>
        <a class="btn btn-ghost js--scroll-to-blog" href="#blog">Recent Blogs</a>
    </div>

</header>