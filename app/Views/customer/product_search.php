<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Pencarian nama produk : <?= $keyword; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- product -->
            <?php foreach ($products as $product) : ?>
                <?php
                $product_image = $db->query("select * from product_images where product_id ='" . $product->id . "'");
                $data_product_image = $product_image->getFirstRow();


                $string_discount = $product_variants->where('product_id', $product->id)->selectMax('discount')->first();
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
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="<?= base_url('product/detail/' . $product->slug) ?>">
                                <img style="height: 350px;" class="default-img" src="<?= base_url('product_images/' . $data_product_image->product_image) ?>" alt="#">
                                <?= $span; ?>
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="<?= base_url('product/detail/' . $product->slug) ?>"><?= $product->title; ?></a></h3>
                            <div class="product-price">
                                <?= $harga; ?>
                                (<?= $data_product_variant->size; ?>)
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>