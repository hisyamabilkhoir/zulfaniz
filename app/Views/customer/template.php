<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title><?= config("App")->appName ?> | <?= config("App")->companyName ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('/template_customer') ?>/images/logo-icon-zulfaniz.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/slicknav.min.css">
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/pagination.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/reset.css">
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url('/template_customer') ?>/css/responsive.css">

    <style>
        .hero-slider .single-slider {
            background-image: url('<?= base_url('banner/zulfaniz-bg-banner.png') ?>');
            image-orientation: none;
        }
    </style>

</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->


    <!-- Header -->
    <header class="header shop">
        <div class="middle-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="<?= base_url('/') ?>"><img src="<?= base_url('/template_customer') ?>/images/zulfaniz-logo-header.jpg" alt="logo"></a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                            <!-- Search Form -->
                            <div class="search-top" method="post" action="<?= base_url('products/search') ?>">
                                <form class="search-form">
                                    <input type="text" placeholder="Cari Produk..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <!-- search -->
                                <form method="post" action="<?= base_url('products/search') ?>">
                                    <input name="search" placeholder="Cari Nama Produk Disini....." type="search">
                                    <button type="submit" class="btnn"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar">
                                <?php
                                if (session()->get('customer_id')) {
                                    $this->cartModel = new \App\Models\CartModel();

                                    $cart = $this->cartModel->where('customer_id', session()->get('customer_id'))->findAll();

                                    $itemCart = count($cart);
                                    $url_profile = 'eshop-customer/profile';
                                    $url_cart = 'eshop-customer/cart';
                                    $text = config("LoginCustomer")->customerName;
                                } else {
                                    $url_profile = 'eshop-customer';
                                    $url_cart = 'eshop-customer';
                                    $text = 'Masuk';
                                    $itemCart = '0';
                                }
                                ?>
                                <a href="<?= base_url($url_profile); ?>" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"><small style="margin-left: 5px;"><?= $text; ?></small></i></a>
                            </div>
                            <div class="sinlge-bar shopping">
                                <a href="<?= base_url($url_cart); ?>" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?= $itemCart; ?></span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9 col-12" style="align-items: center;">
                            <div class="menu-area">
                                <!-- Main Menu -->
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <?php
                                                $request = \Config\Services::request();
                                                $uri = $request->uri;
                                                ?>
                                                <li class="<?= ($uri->getSegment(1) === "") ? "active" : "" ?>"><a href="<?= base_url('/') ?>">Beranda</a></li>
                                                <li class="<?= ($uri->getSegment(1) === "products") ? "active" : "" ?>"><a href="<?= base_url('/products') ?>">Produk</a></li>
                                                <li class="<?= ($uri->getSegment(1) === "contact") ? "active" : "" ?>"><a href="<?= base_url('/contact') ?>">Hubungi Kami</a></li>
                                                <?php if (session()->get('customer_id')) : ?>
                                                    <li><a href="#">Akun<i class="ti-angle-down"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="<?= base_url('/eshop-customer/order-histories') ?>">Riwayat Pesanan</a></li>
                                                            <li><a href="<?= base_url('/eshop-customer/profile') ?>">Profile</a></li>
                                                            <li><a href="<?= base_url('/eshop-customer/cart') ?>">Keranjang</a></li>
                                                            <li><a href="<?= base_url('/eshop-customer/checkout') ?>">Checkout</a></li>
                                                            <li><a href="<?= base_url('/eshop-customer/logout') ?>">Keluar</a></li>
                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <!--/ End Main Menu -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->

    <!-- Main-Conten -->
    <?= $this->renderSection("page_content") ?>

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo">
                                <a href="<?= base_url('/') ?>"><img src="<?= base_url('/template_customer') ?>/images/zulfaniz-logo-footer.png" alt="#"></a>
                            </div>
                            <p class="text">Kini menghadirkan beragam kebutuhan fashion muslimah mulai dari anak-anak hingga dewasa dari berbagai macam jenis seperti kain, hijab, busana yang lengkap akan pilihan</p>
                            <p class="call">Punya Pertanyaan? Hubungi !<span><a href="tel:123456789">+62 859 7372 9267</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Informasi</h4>
                            <ul>
                                <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                                <li><a href="<?= base_url('products') ?>">Produk</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Customer Service</h4>
                            <ul>
                                <li><a href="<?= base_url('contact') ?>">Hubungi Kami</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Kunjungi Kami</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>Jalan Pahlawan No. 17</li>
                                    <li>Desa Dawuan</li>
                                    <li>Kec. Tengah Tani, Kab. Cirebon</li>
                                    <li>zulfanizbusiness@gmail.com</li>
                                    <li>+62 859 7372 9267</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="https://id-id.facebook.com/"><i class="ti-facebook"></i></a></li>
                                <li><a href="https://twitter.com/?lang=id"><i class="ti-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/?hl=id"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="copyright">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p> Copyright &copy; <?= config("App")->appName ?> - <?= config("App")->companyName ?> - All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right">
                                <img src="<?= base_url('/template_customer') ?>/images/payments.png" alt="#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /End Footer Area -->

    <!-- Jquery -->
    <script src="<?= base_url('/template_customer') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('/template_customer') ?>/js/jquery-migrate-3.0.0.js"></script>
    <script src="<?= base_url('/template_customer') ?>/js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="<?= base_url('/template_customer') ?>/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('/template_customer') ?>/js/bootstrap.min.js"></script>
    <!-- Color JS -->
    <script src="<?= base_url('/template_customer') ?>/js/colors.js"></script>
    <!-- Slicknav JS -->
    <script src="<?= base_url('/template_customer') ?>/js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="<?= base_url('/template_customer') ?>/js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="<?= base_url('/template_customer') ?>/js/magnific-popup.js"></script>
    <!-- Waypoints JS -->
    <script src="<?= base_url('/template_customer') ?>/js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="<?= base_url('/template_customer') ?>/js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="<?= base_url('/template_customer') ?>/js/nicesellect.js"></script>
    <!-- Flex Slider JS -->
    <script src="<?= base_url('/template_customer') ?>/js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="<?= base_url('/template_customer') ?>/js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="<?= base_url('/template_customer') ?>/js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="<?= base_url('/template_customer') ?>/js/easing.js"></script>
    <!-- Active JS -->
    <script src="<?= base_url('/template_customer') ?>/js/active.js"></script>
    <script src="<?= base_url('/template_customer') ?>/js/pagination.min.js"></script>

    <?= $this->renderSection("page_script") ?>
</body>

</html>