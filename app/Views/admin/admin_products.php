<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Data Produk</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/products'); ?>">Produk</a>
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
                        <h4 class="card-title">Data Produk</h4>
                        <a href="<?= base_url('eshop-admin/products/view-add') ?>" class="btn btn-primary btn-round ml-auto">
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
                                    <th>Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($products as $product) :
                                    $d++;
                                ?>
                                    <tr>
                                        <td align="text-center"><?= $d ?></td>
                                        <td><?= $product->title ?></td>
                                        <td><?= $product->category_name ?></td>
                                        <td class='text-center'>
                                            <a href="<?= base_url('eshop-admin/products/view_edit/' . $product->id); ?>" class="btn btn-success btn-sm text-white">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('eshop-admin/product/variants/' . $product->id); ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-boxes"></i>
                                            </a>
                                            <a href="<?= base_url('eshop-admin/products/delete/' . $product->id); ?>" onclick="return confirm('Apakah anda yakin hapus <?= $product->title ?>')" class="btn btn-danger btn-sm text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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