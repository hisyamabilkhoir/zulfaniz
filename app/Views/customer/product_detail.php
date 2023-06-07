<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="container mt-5 mb-5">
    <div class="row no-gutters">
        <div class="col-12">
            <?php if (session('msg_status')) : ?>
                <div class="alert alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
                    <?= session('msg'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <!-- Product Slider -->
            <div class="product-gallery">
                <?php
                if (count($product_images) > 1) {
                    $status = 'active';
                } else {
                    $status = ' mb-5';
                }
                ?>
                <div class="quickview-slider-<?= $status; ?>">
                    <?php foreach ($product_images as $product_image) : ?>
                        <div class="single-slider">
                            <img style="height: 600px; width: 100%;" src="<?= base_url('product_images/' . $product_image->product_image) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End Product slider -->
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="quickview-content">
                <p>
                    <?php
                    $qCategory = $db->query("select * from categories where id='" . $product->category_id . "'");
                    $dCategory = $qCategory->getFirstRow();
                    echo $dCategory->name;
                    ?>
                </p>
                <h2><?= $product->title; ?></h2>
                <div class="quickview-ratting-review">
                    <div class="quickview-ratting-wrap">
                        <div class="quickview-ratting">
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="yellow fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <?php
                    $product_variant = $db->query("select * from product_variants where product_id ='" . $product->id . "'");
                    $data_product_variant = $product_variant->getFirstRow();

                    if ($data_product_variant->discount == 0) {
                        $harga = 'Rp. ' . number_format($data_product_variant->price, 0, ",", ".") . '';
                    } else {
                        $diskon = ($data_product_variant->price * $data_product_variant->discount) / 100;
                        $perhitungan_harga = $data_product_variant->price - $diskon;
                        $harga = '<span class="old">Rp. ' . number_format($data_product_variant->price, 0, ",", ".") . '</span><small>(' . $data_product_variant->discount . '%)</small>
                                  <br>
                                  Rp. ' . number_format($perhitungan_harga, 0, ",", ".") . '';
                    }
                    ?>
                    <div id="stock">
                        <div class="quickview-stock">
                            <span><i class="fa fa-check-circle-o"></i><?= $data_product_variant->stock; ?> in stock</span>
                        </div>
                    </div>
                </div>
                <h3 id="harga">
                    <?= $harga; ?>
                </h3>
                <div class="quickview-peragraph">
                    <p><?= $product->content; ?></p>
                </div>
                <form method="post" action="<?= base_url('eshop-customer/add-to-cart') ?>">
                    <div class="size mt-5">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <h5 class="title">Varian</h5>
                                <select name="product_variant_id" id="product_variant_id">
                                    <?php foreach ($product_variants as $product_variant) : ?>
                                        <option value="<?= $product_variant->id ?>"><?= $product_variant->size; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="quantity">
                        <!-- Input Order -->
                        <div class="input-group">
                            <div class="button minus">
                                <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                    <i class="ti-minus"></i>
                                </button>
                            </div>
                            <input type="text" name="quantity" class="input-number" data-min="1" data-max="1000" value="1">
                            <div class="button plus">
                                <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quantity">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!--/ End Input Order -->
                    </div>
                    <div class="add-to-cart">
                        <button type="submit" class="btn">Tambah Ke Keranjang</button>
                    </div>
                </form>
                <div class="default-social">
                    <h4 class="share-now">Bagikan:</h4>
                    <ul>
                        <li><a class="facebook" target="_blank" href="https://id-id.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" target="_blank" href="https://twitter.com/?lang=id"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="youtube" target="_blank" href="https://id.pinterest.com/"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a class="dribbble" target="_blank" href="https://myaccount.google.com/profile"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($products_mores as $product) : ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <?php
                $product_image = $db->query("select * from product_images where product_id ='" . $product->id . "'");
                $data_product_image = $product_image->getFirstRow();


                $string_discount = $productVariantModel->where('product_id', $product->id)->selectMax('discount')->first();
                $discount = intval($string_discount->discount);

                $product_variant = $db->query("select * from product_variants where product_id ='" . $product->id . "' and discount ='" . $discount . "'");
                $data_product_variant = $product_variant->getFirstRow();

                if ($data_product_variant->discount == 0) {
                    $span = '<span class="out-of-stock">Hot</span>';
                    $harga = '<span>Rp. ' . number_format($data_product_variant->price, 0, ",", ".") . '</span>';
                } else {
                    $diskon = ($data_product_variant->price * $discount) / 100;
                    $perhitungan_harga = $data_product_variant->price - $diskon;
                    $harga = '<span class="old">Rp. ' . number_format($data_product_variant->price, 0, ",", ".") . '</span>
                                      <span>Rp. ' . number_format($perhitungan_harga, 0, ",", ".") . '</span>';
                    $span = '<span class="price-dec">' . $data_product_variant->discount . '% Diskon</span>';
                }
                ?>
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-img">
                        <a href="<?= base_url('product/detail/' . $product->slug) ?>">
                            <img style="height: 350px;" class="default-img" src="<?= base_url('product_images/' . $data_product_image->product_image) ?>">
                            <?= $span; ?>
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="<?= base_url('product/detail/' . $product->slug) ?>"><?= $product->title; ?></a></h3>
                        <div class="product-price">
                            <?= $harga; ?>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>

<script type="text/javascript">
    $("#product_variant_id").change(function() {
        $.ajax({
            url: "<?= base_url('product/detail/select-variant') ?>",
            type: "post",
            data: {
                product_variant_id: $('#product_variant_id').val(),
            },
            success: function(data) {
                $("#harga").replaceWith(data);
            }
        });

        $.ajax({
            url: "<?= base_url('product/detail/select-variant-stock') ?>",
            type: "post",
            data: {
                product_variant_id: $('#product_variant_id').val(),
            },
            success: function(data) {
                $("#stock").replaceWith(data);
            }
        });
    });
</script>

<?= $this->endSection() ?>