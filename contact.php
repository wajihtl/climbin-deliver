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
                    <h2>Contact Us</h2>
                    <div class="bt-option">
                        <a>Home</a>
                        <span>Contact us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title contact-title">
                    <span>Contact Us</span>
                    <h2>GET IN TOUCH</h2>
                </div>
                <div class="contact-widget">
                    <div class="cw-text">
                        <i class="fa fa-map-marker"></i>
                        <p>Rue Jaber Ibn Hayan 2046 La Marsa,<br /> Tunisia</p>
                    </div>
                    <div class="cw-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>+216-23-727-427</li>
                        </ul>
                    </div>
                    <div class="cw-text email">
                        <i class="fa fa-envelope"></i>
                        <p>climbin.tunis@gmail.com</p>
                    </div>
                    <div class="cw-text email">
                        <i class="fa fa-envelope-open-o"></i>
                        <p>inscription newsletter <a href="">ici</a> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="leave-comment">
                    <form action="#">
                        <input type="text" placeholder="Name">
                        <input type="text" placeholder="Email">
                        <textarea placeholder="Comment"></textarea>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="map">

            <iframe src="https://maps.google.com/maps?q=climb'in&t=&z=15&ie=UTF8&iwloc=&output=embed" height="550" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>
</section>
<!-- Contact Section End -->


< <?php require_once('./footer.php'); ?>