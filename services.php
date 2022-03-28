<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("./includes/db.php");
include './header.php' ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Services</h2>
                    <div class="bt-option">
                        <a href="./index.html">Home</a>
                        <span>Services</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Services Section Begin -->
<section class="services-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>PUSH YOUR LIMITS FORWARD</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM services";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($services = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $services['id'];
                $Title = $services['Title'];
                $Content = $services['Content'];
                $Picture = $services['Picture'];

                ?>

                <img src="img/services/<?php echo $Picture; ?>" width="300px" height="299px" alt="">
                <div class="ss-text" style="width:280px; height: 299px;margin-bottom: 7px">
                    <h4><?php echo $Title; ?></h4>
                    <p><?php echo $Content; ?>DT</p>

                </div>

            <?php } ?>
        </div>
        >
    </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Banner Section Begin -->
<section class="banner-section set-bg" data-setbg="img/banner-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="bs-text service-banner">
                    <h2>Exercise until the body obeys.</h2>
                    <div class="bt-tips">Where health, beauty and fitness meet.</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Pricing Section Begin -->
<section class="pricing-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <div class="section-title">
                        <h2>Nos abonnement</h2>
                    </div>
                </div>
            </div>
        </div>


        <div class="test">
            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3> Adulte</h3>
                    <?php
                    $sql = "SELECT * FROM adult";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($adult = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $id = $adult['id'];
                        $type = $adult['type'];
                        $Price = $adult['Price'];
                        $description = $adult['description'];

                        ?>

                        <div class="pi-price">
                            <h2><?php echo $type; ?></h2>
                        </div>
                        <ul>
                            <li><?php echo $Price; ?></li>
                            <li><?php echo $description; ?></li>
                        </ul>
                    <?php } ?>


                </div>
            </div>

            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3>Enfant</h3>
                    <?php
                    $sql = "SELECT * FROM kid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while ($kid = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $id = $kid['id'];
                        $Title = $kid['Title'];
                        $Price = $kid['Price'];
                        $description = $kid['description'];

                        ?>
                        <div class="pi-price">
                            <h2><?php echo $Title; ?></h2>
                        </div>
                        <ul>
                            <li><?php echo $Price; ?></li>
                            <li><?php echo $description; ?></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3>Club</h3>
                    <div class="pi-price">
                        <h2>10 Séeance</h2>
                    </div>
                    <ul>
                        <li>10 séances</li>
                        <li>Valable a vie</li>
                        <li>Pas de restriction de temps</li>
                    </ul>
                    <div class="pi-price">
                        <h2>3 mois</h2>
                    </div>
                    <ul>
                        <li>Prix 000 DT</li>
                        <li>Valable a vie</li>
                        <li>Pas de restriction de temps</li>
                    </ul>
                    <div class="pi-price">
                        <h2>6 mois</h2>
                    </div>
                    <ul>
                        <li>10 séances</li>
                        <li>Valable a vie</li>
                        <li>Pas de restriction de temps</li>
                    </ul>
                    <div class="pi-price">
                        <h2>12 mois</h2>
                    </div>
                    <ul>
                        <li>10 séances</li>
                        <li>Valable a vie</li>
                        <li>Pas de restriction de temps</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="pricing-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <div class="section-title">
                        <h2>Nos activité extra</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM classes";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($classes = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $classes['id'];
                $Title = $classes['Title'];
                $Description = $classes['Description'];
                $Content = $classes['Content'];
                $Picture = $classes['Picture'];

                ?>

                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="./img/classes/<?php echo $Picture; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $Title; ?></span>
                            <h5><?php echo $Description; ?></h5>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>


            <?php }
            ?>
        </div>
</div>
</div>
</div>
</section>
<!-- Footer Section Begin -->
<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="fs-about">
                    <div class="fa-logo">
                        <a href="#"><img src="img/logo.png" alt=""></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore dolore magna aliqua endisse ultrices gravida lorem.</p>
                    <div class="fa-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="fs-widget">
                    <h4>Useful links</h4>
                    <ul>
                        <li><a href="./about-us">About</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="./class-details.php">Classes</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="copyright-text">
                    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved 2021| This template is made with <i class="fa fa-heart"
                                                                                aria-hidden="true"></i> by Jihed
                        Mohamed</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/jquery.barfiller.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>


</body>

</html>