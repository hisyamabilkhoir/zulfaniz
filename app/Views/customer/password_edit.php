<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="form-main">
                        <div class="title">
                            <h3>Ubah Password</h3>
                        </div>
                        <form action="<?= base_url('eshop-customer/password/update'); ?>" class="form" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <?php if (session('msg_status')) : ?>
                                        <div class="alert alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
                                            <?= session('msg'); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <input type="hidden" name="id" value="<?= session()->get('customer_id'); ?>">
                                    <input type="hidden" name="name" value="<?= config("LoginCustomer")->customerName; ?>">
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input name="password" type="password" value="<?= (old('password')); ?>" class="form-control <?= validation_show_error('password') ? 'is-invalid' : ''; ?>" placeholder="Masukan password baru . . ." required>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input name="confirm_password" type="password" value="<?= (old('confirm_password')); ?>" class="form-control <?= validation_show_error('confirm_password') ? 'is-invalid' : ''; ?>" placeholder="Masukan konfirmasi password . . ." required>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('confirm_password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <a class="btn text-white" href="<?= base_url('eshop-customer/profile') ?>">Kembali</a>
                                        <button type="submit" class="btn float-right">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>