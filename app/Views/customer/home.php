<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>

<!-- Slider Area -->
<section class="hero-slider">
    <!-- Single Slider -->
    <div class="single-slider">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-9 offset-lg-1 col-12">
                    <div class="text-inner">
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <div class="hero-text">
                                    <h1><span>Mau Pakaian Muslimah Syar'i ? </span>Zulfaniz Muslimah</h1>
                                    <p>Kini menghadirkan beragam pakaian muslimah <br> Mulai dari anak-anak hingga dewasa <br> Tunggu apa lagi </p>
                                    <div class="button">
                                        <a href="<?= base_url('products') ?>" class="btn">Belanja Sekarang !</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            <!-- Single Banner  -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    <img style="height: 800px;" src="<?= base_url('banner/3.jpg') ?>">
                    <!-- <div class="content">
                        <p>Tersedia !</p>
                        <h3>Berbagai <br> Jenis Kain</h3>
                        <a style="margin-top: -10px;" href="<?= base_url('products') ?>">Belanja Sekarang</a>
                    </div> -->
                </div>
            </div>
            <!-- /End Single Banner  -->
            <!-- Single Banner  -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    <img style="height: 800px;" src="<?= base_url('banner/26.jpg') ?>" alt="#">
                    <!-- <div class="content">
                        <p>Tersedia !</p>
                        <h3>Berbagai <br> Jenis Hijab</h3>
                        <a style="margin-top: -10px;" href="<?= base_url('products') ?>">Belanja Sekarang</a>
                    </div> -->
                </div>
            </div>
            <!-- /End Single Banner  -->
            <!-- Single Banner  -->
            <div class="col-lg-4 col-12">
                <div class="single-banner tab-height">
                    <img style="height: 800px;" src="<?= base_url('banner/28.jpg') ?>" alt="#">
                    <!-- <div class="content">
                        <p>Tersedia !</p>
                        <h3>Berbagai <br> Jenis Busana Mulimah</h3>
                        <a style="margin-top: -10px;" href="<?= base_url('products') ?>">Belanja Sekarang</a>
                    </div> -->
                </div>
            </div>
            <!-- /End Single Banner  -->
        </div>
    </div>
</section>
<!-- End Small Banner -->


<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Produk Poluler</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
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
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->


<!-- Start Cowndown Area -->
<section class="cown-down">
    <div class="section-inner ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-12 padding-right">
                    <div class="image">
                        <img style="height: 500px;" src="<?= base_url('banner/banner.jpg') ?>" alt="#">
                    </div>
                </div>
                <div class="col-lg-6 col-12 padding-left">
                    <div class="content">
                        <div class="heading-block">
                            <p class="small-title">Kini Tersedia !</p>
                            <h3 class="title">Kerudung Syar'i lengkap dengan cadar</h3>
                            <p class="text">Kapan lagi mendapatkan produk dengan paket lengkap? tentunya harga murah dan barang berkualitas ! ayo sebelum kehabisan harga mulai dari :</p>
                            <h1 class="price">Rp. 30.000<s>Rp. 100.000</s></h1>
                            <div class="coming-time">
                                <div class="clearfix" data-countdown="2023/04/30"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /End Cowndown Area -->

<!-- Start Shop Blog  -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Ulasan Pembeli</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="<?= base_url('template_customer/images/1.jpg') ?>" alt="#">
                    <div class="content">
                        <p class="date">Senin, 13 April 2022</p>
                        <p class="title">Inayah</p>
                        <p>Ummi Alhamdulillah dress gamisnya sudh dipakai hari ini, MasyaaAllah bagus sekali, bahanya adem, nyaman dipakai, warnanya lembut bersinar. Suami suka banget ummi.</p>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="<?= base_url('template_customer/images/2.jpg') ?>" alt="#">
                    <div class="content">
                        <p class="date">Kamis, 10 Agustus 2022</p>
                        <p class="title">Mm Haikal</p>
                        <p>MasyaaAllah karyanya mmh hisyam bagus bagus semua, model nya kekinian, aku suka banget !!</p>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="<?= base_url('template_customer/images/3.jpg') ?>" alt="#">
                    <div class="content">
                        <p class="date">Selasa, 14 November 2022</p>
                        <p class="title">Ummi Jihan</p>
                        <p>Suka banget sama gamis gamis syar'i nya, warna beragam dan modelnya pun beragam, adem lembut, nyaman dipakai.</p>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Blog  -->

<!-- Start Shop Services Area -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Pengiriman Cepat</h4>
                    <p>JNE, J&T, TIKI, POS</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Garansi</h4>
                    <p>Dijamin Dalam 7 Hari</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Keamanan Pembayaran</h4>
                    <p>100% Pembayaran Terjaga</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Harga Terbaik</h4>
                    <p>Harga Murah Kualitas Tinggi</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services Area -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                <div class="single-slider">
                                    <img src="https://via.placeholder.com/569x528" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="https://via.placeholder.com/569x528" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="https://via.placeholder.com/569x528" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="https://via.placeholder.com/569x528" alt="#">
                                </div>
                            </div>
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>Flared Shift Dress</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="#"> (1 customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                </div>
                            </div>
                            <h3>$29.00</h3>
                            <div class="quickview-peragraph">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                            </div>
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select>
                                            <option selected="selected">s</option>
                                            <option>m</option>
                                            <option>l</option>
                                            <option>xl</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Color</h5>
                                        <select>
                                            <option selected="selected">orange</option>
                                            <option>purple</option>
                                            <option>black</option>
                                            <option>pink</option>
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
                                <a href="#" class="btn">Add to cart</a>
                                <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                            </div>
                            <div class="default-social">
                                <h4 class="share-now">Share:</h4>
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
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<?= $this->endSection() ?>