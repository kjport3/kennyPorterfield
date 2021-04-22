<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Kenny's Blog Admin
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);
                                    $user_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>$user_count</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?details=user">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    $comment_count = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>$comment_count</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?details=comment">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query($connection, $query);
                                    $post_count = mysqli_num_rows($select_all_posts);
                                    echo "<div class='huge'>$post_count</div>";
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query($connection, $query);
                                    $category_count = mysqli_num_rows($select_all_categories);
                                    echo "<div class='huge'>$category_count</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            if (isset($_GET['details'])) {
                $details = $_GET['details'];
                if ($details == 'comment') {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3><a href="./comments.php">Comment Manager</a></h3>
                        </div>
                    </div>
                    <?php
                } else if ($details == 'user') {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3><a href="./users.php">User Manager</a></h3>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <br><br>

            <div class="row">
                <div class="col-lg-9">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages': ['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([

                                <?php

                                if (isset($_GET['details'])) {
                                    $details = $_GET['details'];
                                    if ($details == 'comment') {
                                        $query = "SELECT * FROM comments WHERE comment_status = 'Pending' ";
                                        $select_all_pending_comments = mysqli_query($connection, $query);
                                        $pending_comment_count = mysqli_num_rows($select_all_pending_comments);

                                        $query = "SELECT * FROM comments WHERE comment_status = 'Approved' ";
                                        $select_all_approved_comments = mysqli_query($connection, $query);
                                        $approved_comment_count = mysqli_num_rows($select_all_approved_comments);

                                        $query = "SELECT * FROM comments WHERE comment_status = 'Denied' ";
                                        $select_all_denied_comments = mysqli_query($connection, $query);
                                        $denied_comment_count = mysqli_num_rows($select_all_denied_comments);

                                        echo $element_text = "['Comments', 'Approved Comments', 'Denied Comments', 'Pending Comments'], ";
                                        echo $element_count = "['#', $approved_comment_count, $denied_comment_count, $pending_comment_count]";
                                    } else if ($details == 'user') {
                                        $query = "SELECT * FROM users WHERE user_role = 'admin' ";
                                        $select_all_admins = mysqli_query($connection, $query);
                                        $admin_user_count = mysqli_num_rows($select_all_admins);

                                        $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                                        $select_all_subscribers = mysqli_query($connection, $query);
                                        $subscriber_user_count = mysqli_num_rows($select_all_subscribers);

                                        $query = "SELECT * FROM users WHERE user_status = 'Pending' ";
                                        $select_all_pending_users = mysqli_query($connection, $query);
                                        $pending_user_count = mysqli_num_rows($select_all_pending_users);

                                        echo $element_text = "['Users', 'Admins', 'Subscribers', 'Pending Users'], ";
                                        echo $element_count = "['#', $admin_user_count, $subscriber_user_count, $pending_user_count]";
                                    }
                                } else {
                                    $details = "Overview";
                                    echo $element_text = "[' ', 'Posts', 'Comments', 'Users', 'Categories'], ";
                                    echo $element_count = "['#', $post_count, $comment_count, $user_count, $category_count]";
                                }
                                ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '<?php echo ucwords($details); ?> Detail',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
