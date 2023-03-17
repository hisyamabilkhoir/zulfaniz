<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="container mt-5 mb-5">
    <div class="row no-gutters">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <!-- Product Slider -->
            <div class="product-gallery">
                <div class="quickview-slider-active">
                    <?php foreach ($product_images as $product_image) : ?>
                        <?php if (count($product_images) > 1) : ?>
                            <div class="single-slider">
                                <img style="height: 600px;" src="<?= base_url('product_images/' . $product_image->product_image) ?>">
                            </div>
                        <?php else : ?>
                            <img style="height: 600px;" src="<?= base_url('product_images/' . $product_image->product_image) ?>">
                        <?php endif; ?>
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
                    ?>
                    <div class="quickview-stock">
                        <span><i class="fa fa-check-circle-o"></i><?= $data_product_variant->stock; ?> in stock</span>
                    </div>
                </div>
                <h3>
                    Rp. <?= number_format($data_product_variant->price, 0, ",", ".") ?>
                </h3>
                <div class="quickview-peragraph">
                    <p><?= $product->content; ?></p>
                </div>
                <div class="size mt-5">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <h5 class="title">Varian</h5>
                            <select>
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
                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                        <div class="button plus">
                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!--/ End Input Order -->
                </div>
                <div class="add-to-cart">
                    <a href="#" class="btn">Tambah Ke Keranjang</a>
                </div>
                <div class="default-social">
                    <h4 class="share-now">Bagikan:</h4>
                    <ul>
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
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
                $product_variant = $db->query("select * from product_variants where product_id ='" . $product->id . "'");
                $data_product_variant = $product_variant->getFirstRow();
                ?>
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-img">
                        <a href="<?= base_url('product/detail/' . $product->slug) ?>">
                            <img style="height: 350px;" class="default-img" src="<?= base_url('product_images/' . $data_product_image->product_image) ?>">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="<?= base_url('product/detail/' . $product->slug) ?>"><?= $product->title; ?></a></h3>
                        <div class="product-price">
                            <span>Rp. <?= number_format($data_product_variant->price, 0, ",", ".") ?></span>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>