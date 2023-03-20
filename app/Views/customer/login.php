<?= $this->extend("template_login") ?>

<?= $this->section("page_content") ?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-1">
                <a href="<?= base_url('/') ?>">
                    <h2 class="heading-section" style="font-weight: bold; font-size: 24px; margin-bottom: 40px;"><?= config("App")->appName ?> - <?= config("App")->companyName ?></h2>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="w-200 mb-5">
                            <h3 class="mb-4 text-center">Silahkan Masuk</h3>
                            <?php if (session('msg_status')) : ?>
                                <div class="alert alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
                                    <?= session('msg'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <form action="<?= base_url('eshop-customer/process-login') ?>" method="POST" class="signin-form">
                            <div class="form-group mt-3 mb-3">
                                <input type="text" name="phone" autofocus class="form-control mb-4" required>
                                <label class="form-control-placeholder" for="phone">No. Handphone / Email</label>
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
                        <div class="text-center">
                            <small>Belum punya akun ? <a href="<?= base_url('/eshop-customer/registration') ?>">Registrasi</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>