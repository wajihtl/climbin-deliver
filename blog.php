<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./includes/db.php");
include './header.php'?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Our Blog</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div class="blog-item">
                        <div class="bi-pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="bi-text">
                            <h5><a href="./blog-details.php">Title.</a></h5>
                            <ul>
                                <li>by Auteur</li>
                                <li>Date</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut
                                labore et dolore magna aliqua accumsan lacus facilisis.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

<?php require_once('./footer.php'); ?>