<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Akun Pengguna</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/admin-accounts'); ?>">Daftar Akun Pengguna</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="#">Tambah Akun Pengguna</a>
        </li>
    </ul>
</div>

<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card" style="padding-bottom: 15px;">
                <div class="card-header">
                    <h3 class="card-title">Tambah Akun Pengguna</h3>
                </div>
                <form method="POST" action="<?= base_url('eshop-admin/admin-accounts/add'); ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Masukan nama . . . " value="<?= (old('name')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukan email . . . " value="<?= (old('email')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username"> Username </label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Masukan username . . . " value="<?= (old('username')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Masukan password . . . " value="<?= (old('password')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password"> Konfirmasi Password</label>
                            <input type="password" class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : ''; ?>" name="confirm_password" id="konfirmasi_password" placeholder="Masukan konfirmasi password . . . " value="<?= (old('confirm_password')); ?>" required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('confirm_password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('eshop-admin/admin-accounts'); ?>">
                            <button type="button" class="btn btn-danger float-left">Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-primary float-right">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>

<?= $this->endSection() ?>