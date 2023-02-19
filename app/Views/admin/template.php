<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= config("App")->appName ?> | <?= config("App")->companyName ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <!-- Fonts and icons -->
    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["<?= base_url('atlantis-lite/css/fonts.min.css') ?>"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('atlantis-lite') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('atlantis-lite') ?>/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url('atlantis-lite') ?>/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="{{ url('/app-admin/dashboard') }}" class="logo text-white">
                    Eshop - <?= config("App")->companyName ?>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="<?= base_url('user.png') ?>" alt="user image" class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('eshop-admin/profile') ?>">Pengaturan
                                            Akun</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('eshop-admin/logout') ?>">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?= config("Login")->adminName ?>
                                    <span class="user-level">Level : Administrator</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <?php
                    $request = \Config\Services::request();
                    $uri = $request->uri;
                    ?>
                    <ul class="nav nav-primary">
                        <li class="nav-item <?= ($uri->getSegment(2) === "dashboard") ? "active" : "" ?>">
                            <a href="<?= base_url('eshop-admin/dashboard') ?>">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Navigasi</h4>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(2) === "product") ? "active" : "" ?>">
                            <a href="<?= base_url('eshop-admin/product') ?>">
                                <i class="fas fa-utensils"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Navigasi Pengguna</h4>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(2) === "user") ? "active" : "" ?>">
                            <a href="<?= base_url('eshop-admin/user') ?>">
                                <i class="fas fa-users"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <?= $this->renderSection("header_section") ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <?php if(session()->has('msg_status')) : ?>
                    <div class="alert alert-<?= session('msg_status') ?>" role="alert">
                        <?= session('msg') ?>
                    </div>
                    <?php endif; ?>
                    <?= $this->renderSection("container_section") ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto">
                        Copyright &copy; <?= config("App")->appName ?> - <?= config("App")->companyName ?>
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url('atlantis-lite') ?>/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url('atlantis-lite') ?>/js/core/popper.min.js"></script>
    <script src="<?= base_url('atlantis-lite') ?>/js/core/bootstrap.min.js"></script>

    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->
    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/datatables/datatables.min.js"></script>

    <!-- Sweet Alert -->
    <script src="<?= base_url('atlantis-lite') ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="<?= base_url('atlantis-lite') ?>/js/atlantis.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables-default').DataTable();
        });
    </script>
    <?= $this->renderSection("script_section") ?>
</body>

</html>