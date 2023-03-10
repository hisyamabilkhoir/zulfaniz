<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Kategori</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/categories'); ?>">Kategori</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>

<!-- Modal Edit -->
<form method="post" action="<?= base_url("eshop-admin/categories/edit_process") ?>">
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori Produk</h5>
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
                    <h5 class="card-title">Tambah Kategori Produk</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url("eshop-admin/categories/add_process"); ?>">
                        <div class="form-group">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="Masukan nama . . . " required autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('name'); ?>
                            </div>
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
                        <h4 class="card-title">Data Kategori Produk</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($categories as $category) {
                                    $d++;
                                ?>
                                    <tr>
                                        <td class='text-center'><?= $d ?></td>
                                        <td><?= $category->name ?></td>
                                        <td class='text-center'>
                                            <button class="btn btn-success btn-sm text-white" onclick="editData(<?= $category->id ?>)" data-toggle="modal" data-target="#modalEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('eshop-admin/categories/delete/' . $category->id); ?>" onclick="return confirm('Apakah anda yakin hapus <?= $category->name ?>')" class="btn btn-danger btn-sm text-white">
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
    function editData(id) {
        $.ajax({
            url: "<?= base_url('eshop-admin/categories/view_edit') ?>" + '/' + (id),
            type: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                $("#view-edit").html(data)
            }
        });
    }
</script>
<?= $this->endSection() ?>