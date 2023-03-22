<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Akun Pembeli</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/customer-accounts'); ?>">Akun Pembeli</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>

<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Akun Pembeli</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Handphone</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = 0;
                            foreach ($customer_accounts as $customer_account) {
                                $d++;
                            ?>
                                <tr>
                                    <td class='text-center'><?= $d ?></td>
                                    <td><?= $customer_account->name ?></td>
                                    <td><?= $customer_account->phone ?></td>
                                    <td><?= $customer_account->email ?></td>
                                    <td><?= nl2br($customer_account->address) ?></td>
                                    <td class='text-center'>
                                        <a href="<?= base_url('eshop-admin/customer-accounts/view-edit/' . $customer_account->id); ?>" class="btn btn-secondary btn-sm text-white">
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

<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<?= $this->endSection() ?>