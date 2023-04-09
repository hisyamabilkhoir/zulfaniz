<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Produk Varian</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/products'); ?>">Daftar Produk</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="#">Daftar Produk Varian</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>

<!-- Modal Edit -->
<form method="post" action="<?= base_url("eshop-admin/product/variants/edit_process") ?>">
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Produk Varian</h5>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="view-edit">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Of Modal Edit -->
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Produk Varian</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url("eshop-admin/product/variants/add_process"); ?>">
                        <input type="hidden" name="productId" value="<?= $productId; ?>">
                        <div class="form-group">
                            <label for="size"> Ukuran </label>
                            <input type="text" class="form-control <?= (validation_show_error('size')) ? 'is-invalid' : ''; ?>" name="size" id="size" placeholder="Masukan ukuran . . . " required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('size'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price"> Harga </label>
                            <input type="number" class="form-control <?= (validation_show_error('price')) ? 'is-invalid' : ''; ?>" name="price" id="price" placeholder="Masukan harga . . . " required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('price'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-label"> Berat Barang</label>
                            <div class="input-group">
                                <input type="number" id="weight" name="weight" class="form-control" placeholder="Berat Barang" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">gram</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="discount" class="form-label">Diskon</label>
                            <div class="input-group">
                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Diskon">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stock"> Stok </label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Masukan stok . . . " required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Produk Varian</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Berat Barang (gram)</th>
                                    <th>Diskon</th>
                                    <th>Stock</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($product_variants as $product_variant) {
                                    $d++;
                                ?>
                                    <tr>
                                        <td class='text-center'><?= $d ?></td>
                                        <td><?= $product_variant->size ?></td>
                                        <td>Rp. <?= number_format($product_variant->price, 0, ",", "."); ?></td>
                                        <td><?= number_format($product_variant->weight, 0, ",", "."); ?></td>
                                        <td><?= number_format($product_variant->discount, 0, ",", "."); ?> %</td>
                                        <td><?= number_format($product_variant->stock, 0, ",", "."); ?></td>
                                        <td class='text-center'>
                                            <button class="btn btn-success btn-sm text-white" onclick="editData(<?= $product_variant->id ?>, <?= $product_variant->product_id ?>)" data-toggle="modal" data-target="#modalEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url("eshop-admin/product/variants/delete/$product_variant->id/$productId"); ?>" onclick="return confirm('Apakah anda yakin hapus ukuran <?= $product_variant->size ?>')" class="btn btn-danger btn-sm text-white">
                                                <i class="fa fa-trash"></i>
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
<script>
    function editData(id, productId) {
        $.ajax({
            url: "<?= base_url('eshop-admin/product/variants/view_edit') ?>",
            type: "POST",
            data: {
                id: id,
                productId: productId,
            },
            success: function(data) {
                $("#view-edit").html(data)
            }
        });
    }
</script>
<?= $this->endSection() ?>