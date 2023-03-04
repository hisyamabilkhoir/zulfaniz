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
            <a style="color: white;" href="<?= base_url('eshop-admin/admin-accounts'); ?>">Daftar Akun Pengguna Admin</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="#">Ubah Akun Pengguna Admin</a>
        </li>
    </ul>
</div>

<?= $this->endSection() ?>

<?= $this->section("page_content") ?>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="card-body card">
            <nav>
                <?php
                if (isset($_GET['active'])) {
                    if ($_GET['active'] === "password") {
                        $header_tab1 = "";
                        $header_tab2 = "active";
                    } else {
                        $header_tab1 = "active";
                        $header_tab2 = "";
                    }
                } else {
                    $header_tab1 = "active";
                    $header_tab2 = "";
                }
                ?>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link <?= $header_tab1 ?>" data-toggle="pill" href="#nav-profile" type="button" role="tab" aria-selected="true">Profil</button>
                    <button class="nav-link <?= $header_tab2 ?>" data-toggle="pill" href="#nav-password" type="button" role="tab" aria-selected="false">Password</button>
                </div>
            </nav>
            <div class="tab-content mt-4" id="nav-tabContent">
                <?php
                if (isset($_GET['active'])) {
                    if ($_GET['active'] === "profile") {
                        $class_siswa_tab = "tab-pane fade active show";
                    } else {
                        $class_siswa_tab = "tab-pane fade";
                    }
                } else {
                    $class_siswa_tab = "tab-pane fade active show";
                }
                ?>
                <div class="<?= $class_siswa_tab ?>" id="nav-profile" role="tabpanel">
                    <form action="<?= base_url('eshop-admin/admin-accounts/update') ?>" method="post">
                        <div class="form-floating form-login">
                            <input type="hidden" name="id" value="<?= $dataAccount->id; ?>">
                            <div class="form-group">
                                <label for="name"> Nama </label>
                                <input type="text" value="<?= (old('name')) ? old('name') : $dataAccount->name ?>" class="form-control shadow-none <?= validation_show_error('name') ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Masukan nama . . . " required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('name'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input type="email" value="<?= (old('email')) ? old('email') : $dataAccount->email ?>" class="form-control shadow-none <?= validation_show_error('email') ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Masukan email . . . " required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone"> Nomor Telepon </label>
                                <input type="text" value="<?= (old('phone')) ? old('phone') : $dataAccount->phone ?>" class="form-control shadow-none <?= validation_show_error('phone') ? 'is-invalid' : ''; ?>" name="phone" id="phone" placeholder="Masukan nomor telepon . . . " required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('phone'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address"> Alamat </label>
                                <textarea type="text" value="<?= (old('address')) ? old('address') : $dataAccount->address ?>" class="form-control shadow-none <?= validation_show_error('address') ? 'is-invalid' : ''; ?>" name="address" id="address" placeholder="Masukan alamat . . ." required autocomplete="off" rows="5"><?= (old('address')) ? old('address') : $dataAccount->address ?></textarea>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('address'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username"> Username </label>
                                <input type="text" value="<?= (old('username')) ? old('username') : $dataAccount->username ?>" class="form-control shadow-none <?= validation_show_error('username') ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Masukan username . . . " required autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('username'); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Status</label>
                                <br>
                                <label>
                                    <input type='radio' name='status' <?php echo $dataAccount->active == 1 ? "checked" : ""; ?> value="1">
                                    Aktif
                                </label>
                                <label class="ml-2">
                                    <input type='radio' name='status' <?php echo $dataAccount->active == 0 ? "checked" : ""; ?> value="0">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="w-100 btn btn-success btn-round" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>


                <?php
                if (isset($_GET['active'])) {
                    if ($_GET['active'] === "password") {
                        $class_kelompok_kelas_tab = "tab-pane fade active show";
                    } else {
                        $class_kelompok_kelas_tab = "tab-pane fade";
                    }
                } else {
                    $class_kelompok_kelas_tab = "tab-pane fade";
                }
                ?>
                <div class="<?= $class_kelompok_kelas_tab ?>" id="nav-password" role="tabpanel">
                    <form action="<?= base_url('eshop-admin/admin-accounts/reset-password') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $dataAccount->id; ?>">
                        <input type="hidden" name="name" value="<?= $dataAccount->name; ?>">
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Password</label>
                            <input type="password" class="form-control shadow-none <?= validation_show_error('password') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" value="<?= (old('password')); ?>" autocomplete="off" required>
                            <div class="invalid-feedback">
                                <?= validation_show_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"><i class="fas fa-lock"></i> Kofirmasi Password</label>
                            <input required type="password" class="form-control shadow-none <?= validation_show_error('confirm_password') ? 'is-invalid' : ''; ?>" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" value="<?= (old('confirm_password')); ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="w-100 btn btn-warning btn-round" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<?= $this->endSection() ?>