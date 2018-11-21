<?php include ('includes/db.php'); ?>
<?php include ('includes/header.php'); ?>

<!-- Navigation -->
<?php include ('includes/navigation.php'); ?>

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
            if (isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
            }
            $query = "select * from posts where post_id = $the_post_id";
            $select_all_post_query = mysqli_query($connection, $query);
            ?>


            <!--Blog Post -->

            <?php while ($row = mysqli_fetch_assoc($select_all_post_query)):
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

                <hr>

                <!-- Blog Comments -->
                <?php
                 if (isset($_POST['create_comment'])){
                     $the_post_id = $_GET['p_id'];
                     $comment_author = $_POST['comment_author'];
                     $comment_email = $_POST['comment_email'];
                     $comment_content = $_POST['comment_content'];

                     $query = "insert into comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                     $query .="values ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                     $create_comment_query = mysqli_query($connection, $query);

                     if (!$create_comment_query){
                         die("Query Failed! ". mysqli_error($connection));
                     }
                 }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                $query = "select * from comments where comment_post_id = {$the_post_id} 
                          and comment_status = 'approved' order by comment_id desc";
                $select_comment_query = mysqli_query($connection, $query);

                if (!$select_comment_query){
                    die("Query Failed! " . mysqli_error($connection));
                }

                $post_comment_count = 0;
                $query = "update posts set post_comment_count = $post_comment_count+1 where post_id = {$the_post_id}";
                $update_comment_count = mysqli_query($connection, $query);
                ?>

                <?php while ($row = mysqli_fetch_assoc($select_comment_query)):
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $comment_author; ?>
                            <small><?= $comment_date; ?></small>
                        </h4>
                        <?= $comment_content; ?>
                    </div>
                </div>
                <?php endwhile; ?>

            <?php endwhile;?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include ('includes/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include ('includes/footer.php'); ?>