<div class="row-medium">
    <img src="resources/img/kp-logo-white.png" alt="Kenny Porterfield" class="logo">
    <a href="/"><img src="resources/img/kp-logo-black.png" alt="Kenny Porterfield" class="logo-black"></a>
    <ul class="main-nav js--main-nav search-li">
        <?php
        $link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        if ($link == 'http://www.kennyporterfield.com/') {
            echo "<li><a href='/' style='border-bottom: 2px solid #e9c46a;'>Home</a></li>";
        } else {
            echo "<li><a href='/'>Home</a></li>";
        }
        ?>
        <?php
        $link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        if ($link == 'http://www.kennyporterfield.com/blog') {
            echo "<li><a href='blog' style='border-bottom: 2px solid #e9c46a;'>Blog</a></li>";
        } else {
            echo "<li><a href='blog'>Blog</a></li>";
        }
        ?>
        <li><a href="#contact" class="js--scroll-to-contact">Contact</a></li>
        <?php
        if (isset($_SESSION['user_role'])) {
            $user_role = $_SESSION['user_role'];
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-btn">Account <i class="fa fa-fw fa-caret-down"></i> </a>
                <ul class="dropdown-content">
                    <?php
                    if ($user_role == 'admin') {
                        ?>
                        <li class="first-dropdown">
                            <a href="admin"><i class="fa fa-fw fa-cog"></i>&nbsp;Admin</a>
                        </li>
                    <?php } else { ?>
                        <li class="first-dropdown">
                            <a href="profile" class="dropdown-link"><i class="fa fa-fw fa-cog"></i>&nbsp;Edit&nbsp;Profile</a>
                        </li>
                    <?php } ?>
                    <li class="divider"></li>
                    <li>
                        <a href="includes/logout.php" class="dropdown-link"><i class="fa fa-fw fa-sign-out"></i>&nbsp;Log
                            Out</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php
        if (!isset($_SESSION['user_role'])) {
            $user_role = $_SESSION['user_role'];
            $link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            if ($link == 'http://www.kennyporterfield.com/login') {
                echo "<li><a href='login' style='border-bottom: 2px solid #e9c46a;'>Login</a></li>";
            } else {
                echo "<li><a href='login'>Login</a></li>";
            }
        } ?>
        <li>
            <form action="search" method="post">
                <div class="input-group nav-search">
                    <input name="search" type="text" class="form-control nav-input" placeholder="Search Blog">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit" style="display:none;">

                        </button>
                    </span>
                </div>
            </form>
        </li>
    </ul>
    <a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
</div>
