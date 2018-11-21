<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>

<!-- Navigation -->
<?php include('includes/navigation.php'); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
            }

            $query = "select * from posts where post_tag like '%$search%'";
            $search_result = mysqli_query($connection, $query);

            if (!$search_result) {
                die("Query Failed" . mysqli_error());
            }

            $count = mysqli_num_rows($search_result);
            if ($count == 0){
                echo "No result found!";
            } else{
            //        <!--Blog Post -->

            while ($row = mysqli_fetch_assoc($search_result)){
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];

            ?>
            <h2>
                <a href="#"><?= $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?= $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
            <hr>
            <p><?= $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php
            }
            }

            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
