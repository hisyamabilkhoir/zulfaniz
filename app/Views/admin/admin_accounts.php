<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Akun Administrator</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/admin-accounts'); ?>">Akun Administrator</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Akun Administrator</h4>
                        <a href="<?= base_url('eshop-admin/admin-accounts/view-add') ?>" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($admin_accounts as $admin_accounts) {
                                    $d++;
                                ?>
                                    <tr>
                                        <td class='text-center'><?= $d ?></td>
                                        <td><?= $admin_accounts->name ?></td>
                                        <td><?= $admin_accounts->email ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($admin_accounts->active == 0) {
                                                echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                            } else if ($admin_accounts->active == 1) {
                                                echo '<span class="badge badge-success">Aktif</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class='text-center'>
                                            <a href="<?= base_url('admin_accounts/view_edit/' . $admin_accounts->id); ?>" class="btn btn-secondary btn-sm text-white">
                                                <i class="fa fa-cog"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<?= $this->endSection() ?>