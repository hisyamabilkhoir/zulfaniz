<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Produk</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#semua" role="tab">Semua</a></li>
                            <?php foreach ($categories as $category) : ?>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?= $category->id; ?>" role="tab"><?= $category->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="semua" role="tabpanel">
                            <div class="tab-single">
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
                        <!--/ End Single Tab -->
                        <?php foreach ($categories as $category) : ?>
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade" id="<?= $category->id; ?>" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        <?php
                                        $by_category = $productModel->where('category_id', $category->id)->findAll();
                                        ?>
                                        <?php if ($by_category) : ?>
                                            <?php foreach ($by_category as $product) : ?>
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
                                        <?php else : ?>
                                            <div class="col-12 text-center mt-5" style="align-items: center;">
                                                <h6>Maaf, Tidak ada produk dalam kategori yang dipilih !</h6>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>