<div class="form-group">
    <input type="hidden" value="<?= $product_variant->id ?>" name="product_variant_id">
    <input type="hidden" value="<?= $productId ?>" name="product_id">
    <label for="size"> Ukuran </label>
    <input type="text" class="form-control" name="size" id="size" value="<?= $product_variant->size ?>" placeholder="Masukan ukuran . . . " required autocomplete="off">
</div>
<div class="form-group">
    <label for="weight" class="form-label"> Berat Barang</label>
    <div class="input-group">
        <input type="number" id="weight" name="weight" class="form-control" value="<?= $product_variant->weight ?>" placeholder="Berat Barang" required>
        <div class="input-group-append">
            <span class="input-group-text">gram</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="discount" class="form-label">Diskon</label>
    <div class="input-group">
        <input type="number" name="discount" id="discount" class="form-control" value="<?= $product_variant->discount ?>" placeholder="Diskon">
        <div class="input-group-append">
            <span class="input-group-text">%</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="price"> Harga </label>
    <input type="number" class="form-control" name="price" id="price" value="<?= $product_variant->price ?>" placeholder="Masukan harga . . . " required autocomplete="off">
</div>
<div class="form-group">
    <label for="stock"> Stok </label>
    <input type="number" class="form-control" name="stock" id="stock" value="<?= $product_variant->stock ?>" placeholder="Masukan stok . . . " readonly autocomplete="off">
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="stock_in" class="form-label">Stok Masuk</label>
                <input type="number" name="stock_in" id="stock_in" class="form-control" placeholder="Stok Keluar">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="stock_out" class="form-label">Stok Keluar</label>
                <input type="number" name="stock_out" id="stock_out" class="form-control" placeholder="Stok Keluar">
            </div>
        </div>
    </div>
    <small class="text-danger">*) Pilih salah satu : stok keluar atau stok masuk</small>
</div>