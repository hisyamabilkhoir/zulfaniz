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
            <a style="color: white;" href="<?= base_url('eshop-admin/products'); ?>">Daftar Produk</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="#">Ubah Produk</a>
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
                    <h3 class="card-title">Ubah Produk</h3>
                </div>
                <form method="POST" action="<?= base_url('eshop-admin/products/edit_process'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="totalImage" value="0">
                    <input type="hidden" name="totalImageEdit" value="0">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title"> Nama </label>
                                    <input type="text" class="form-control <?= (validation_show_error('title')) ? 'is-invalid' : ''; ?>" name="title" value="<?= $product->title ?>" id="title" placeholder="Masukan nama . . . " required autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('title'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Kategori Produk</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="" disabled selected>Pilih Kategori Produk</option>
                                        <?php foreach ($categories as $cg) : ?>
                                            <option value="<?= $cg->id ?>" <?= ($product->category_id == $cg->id) ? 'selected' : '' ?>><?= $cg->name ?></option>;
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i = 0;
                    foreach ($product_images as $product_image) :
                        $i++;
                    ?>
                        <div class="row" data-index="<?= $i ?>">
                            <div class="col-md-6">
                                <img src="<?= base_url("product_images/$product_image->product_image") ?>" class="img-thumbnail mx-auto d-block" width="300px" height="200px">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customFile" class="form-label">Gambar Produk <?= $i ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" name="id_image_edit_<?= $i ?>" value="<?= $product_image->id ?>">
                                            <input type="file" name="image_edit_<?= $i ?>" data-input="<?= $i ?>" class="custom-file-input">
                                            <label class="custom-file-label" data-label="<?= $i ?>" for="customFile">Choose file</label>
                                        </div>
                                        <a href='<?= base_url("eshop-admin/product-images/$product_image->product_id/delete/$product_image->id"); ?>' onclick="return confirm('Apakah anda yakin hapus ?')" class="btn btn-danger ml-3 btn-sm text-white">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    $i++;
                    ?>
                    <div class="row" data-index="<?= $i ?>">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="customFile" class="form-label">Gambar Produk <?= $i ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="image_0" data-input="<?= $i ?>" class="custom-file-input">
                                        <label class="custom-file-label" data-label="<?= $i ?>" for="customFile">Choose file</label>
                                    </div>
                                    <button data-create="<?= $i ?>" class="btn ml-3 btn-primary btn-sm text-white">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content"> Konten </label>
                        <input id="content" type="hidden" value="<?= $product->content ?>" name="content" required>
                        <trix-editor input="content"></trix-editor>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('eshop-admin/products'); ?>">
                            <button type="button" class="btn btn-danger float-left">Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
    let index = $('div[data-index]').map(function() {
        return $(this).attr('data-index');
    }).get().pop();

    let createFirst = $('button[data-create]').map(function() {
        return $(this).attr('data-create');
    }).get(0);

    for (let i = 1; i <= index; i++) {
        $(`input[data-input="${i}"]`).change(function(e) {
            var fileName = e.target.files[0].name;
            $(`label[data-label="${i}"]`).html(fileName);
        });
        $('input[name="totalImageEdit"]').val(i);
    }

    $(`button[data-create=${createFirst}]`).click(function(e) {
        e.preventDefault();
        let newIndex = parseInt(index) + 1;
        $(`div[data-index=${index}]`).after(
            `
            <div class="row" data-index="${newIndex}">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="customFile" class="form-label">Gambar Produk ${newIndex}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image_${newIndex}" data-input="${newIndex}" class="custom-file-input">
                                <label class="custom-file-label" data-label="${newIndex}" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `
        )
        $('input[name="totalImage"]').val(newIndex);
        for (let index = 1; index <= newIndex; index++) {
            $(`input[data-input="${newIndex}"]`).change(function(e) {
                var fileName = e.target.files[0].name;
                $(`label[data-label="${newIndex}"]`).html(fileName);
            });
        }
        index = newIndex;
    })
</script>
<?= $this->endSection() ?>