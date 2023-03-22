<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Profil</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a style="color: white;" href="<?= base_url('eshop-admin/dashboard'); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="<?= base_url('eshop-admin/orders'); ?>">Profil</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-white bg-success">
                    Ubah Profil
                </div>
                <div class="card-body">
                    <form action="<?= base_url('eshop-admin/profile/save') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $admin->id ?>">
                        <div class="form-group mb-3">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Masukan nama . . . " value="<?= $admin->name; ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username"> Username </label>
                            <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Masukan username . . . " value="<?= $admin->username; ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('username'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email"> Email </label>
                            <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukan email . . . " value="<?= $admin->email ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone"> Nomor Telepon </label>
                            <input type="text" class="form-control <?= (validation_show_error('phone')) ? 'is-invalid' : ''; ?>" name="phone" id="phone" placeholder="Masukan nomor telepon . . . " value="<?= $admin->phone ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('phone'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address"> Alamat</label>
                            <textarea type="text" class="form-control <?= (validation_show_error('address')) ? 'is-invalid' : ''; ?>" name="address" id="address" placeholder="Masukkan Alamat ..." required autocomplete="off"><?= $admin->address ?></textarea>
                            <div class="invalid-feedback">
                                <?= validation_show_error('address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="w-100 btn btn-success btn-round" type="submit">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-white bg-warning">
                    Reset Password
                </div>
                <div class="card-body">
                    <form action="<?= base_url('eshop-admin/profile/password/reset') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $admin->id ?>">
                        <input type="hidden" name="name" value="<?= $admin->name ?>">
                        <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukan password . . . " value="<?= (old('password')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password"> Konfirmasi Password</label>
                            <input type="password" class="form-control <?= (validation_show_error('confirm_password')) ? 'is-invalid' : ''; ?>" name="confirm_password" id="konfirmasi_password" placeholder="Masukan konfirmasi password . . . " value="<?= (old('confirm_password')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="w-100 btn btn-warning btn-round text-white" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?= $this->endSection() ?>