<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('login') ?>/css/style.css">
    <style>
        .ftco-section {
            padding: 2em 0 !important;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-1">
                    <h2 class="heading-section">Login</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="w-200 mb-5">
                                <h3 class="mb-4 text-center">Silahkan Masuk</h3>
                                <p style="color: red;" class="text-center">
                                    <?php
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                    }
                                    ?>
                                </p>
                            </div>
                            <form action="<?= base_url('eshop-admin/process-login') ?>" method="POST" class="signin-form">
                                <div class="form-group mt-3 mb-3">
                                    <input type="text" name="username" autofocus class="form-control mb-4" required>
                                    <label class="form-control-placeholder" for="username">Username / Email</label>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="password" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" style="background-color: #1572e8;" class="form-control text-white btn rounded submit px-3">Masuk</button>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('login') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('login') ?>/js/popper.js"></script>
    <script src="<?= base_url('login') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('login') ?>/js/main.js"></script>

</body>

</html>