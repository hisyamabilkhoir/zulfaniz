<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="form-main">
                        <div class="title">
                            <h3>Ubah Biodata Diri</h3>
                        </div>
                        <form action="<?= base_url('eshop-customer/profile/update'); ?>" class="form" method="post">
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
                                <div class="col-lg-6 col-12">
                                    <input type="hidden" name="id" value="<?= session()->get('customer_id'); ?>">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="name" type="text" value="<?= (old('name')) ? old('name') : config("LoginCustomer")->customerName; ?>" class="form-control <?= validation_show_error('name') ? 'is-invalid' : ''; ?>" placeholder="Masukan nama . . ." required>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>No. Handphone</label>
                                        <input name="phone" type="text" value="<?= (old('phone')) ? old('phone') : config("LoginCustomer")->customerPhone; ?>" class="form-control <?= validation_show_error('phone') ? 'is-invalid' : ''; ?>" placeholder="Masukan nomor handphone . . ." required>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('phone'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" value="<?= (old('email')) ? old('email') : config("LoginCustomer")->customerEmail; ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>" placeholder="Masukan email . . ." required>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group message">
                                        <label>Alamat</label>
                                        <textarea name="address" value="<?= (old('address')) ? old('address') : config("LoginCustomer")->customerAddress; ?>" class="form-control <?= validation_show_error('address') ? 'is-invalid' : ''; ?>" placeholder="Masukan alamat . . ." required><?= (old('address')) ? old('address') : config("LoginCustomer")->customerAddress; ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('address'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <a class="btn text-white" href="<?= base_url('eshop-customer/profile') ?>">Kembali</a>
                                        <button type="submit" class="btn float-right">Simpan</button>
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