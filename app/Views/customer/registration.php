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
                            <h3 class="mb-4 text-center">Silahkan Registrasi</h3>
                        </div>
                        <form action="<?= base_url('eshop-customer/process-registration') ?>" method="POST" class="signin-form">
                            <div class="form-group">
                                <input type="text" name="name" autofocus class="form-control mb-4 <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" value="<?= (old('name')); ?>" required>
                                <label class="form-control-placeholder" for="name">Nama</label>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control mb-4 <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" value="<?= (old('email')); ?>" required>
                                <label class="form-control-placeholder" for="email">Email</label>
                                <div class="invalid-feedback" style="margin-top: -20px; margin-bottom: 35px;">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control mb-4 <?= (validation_show_error('phone')) ? 'is-invalid' : ''; ?>" value="<?= (old('phone')); ?>" required>
                                <label class="form-control-placeholder" for="phone">No. Handphone</label>
                                <div class="invalid-feedback" style="margin-top: -20px; margin-bottom: 35px;">
                                    <?= validation_show_error('phone'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="address" id="address" rows="5" class="form-control mb-4 <?= (validation_show_error('address')) ? 'is-invalid' : ''; ?>" required><?= (old('address')); ?></textarea>
                                <label class="form-control-placeholder" for="address">Alamat</label>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control mb-4 <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" value="<?= (old('password')); ?>" required>
                                <label class="form-control-placeholder" for="password">Password</label>
                                <div class="invalid-feedback" style="margin-top: -20px; margin-bottom: 35px;">
                                    <?= validation_show_error('password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="confirm_password" name="confirm_password" type="password" class="form-control mb-4 <?= (validation_show_error('confirm_password')) ? 'is-invalid' : ''; ?>" value="<?= (old('confirm_password')); ?>" required>
                                <label class="form-control-placeholder" for="confirm_password">Konfirmasi Password</label>
                                <div class="invalid-feedback" style="margin-top: -20px;">
                                    <?= validation_show_error('confirm_password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" style="background-color: #1572e8;" class="form-control text-white btn rounded submit px-3">Registrasi</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <small>Sudah punya akun ? <a href="<?= base_url('/eshop-customer') ?>">Masuk</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>