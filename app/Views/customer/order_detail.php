<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="shopping-cart section">
    <div class="m-3">
        <div class="row">
            <div class="col-lg-7 col-12">
                <?php foreach ($products as $product) : ?>
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <?php
                                if (count($product->product_images) > 1) {
                                    $status = 'active';
                                } else {
                                    $status = ' mb-5';
                                }
                                $i = 0;
                                ?>
                                <div class="quickview-slider-<?= $status; ?>">
                                    <?php foreach ($product->product_images as $product_image) : ?>
                                        <div class="single-slider">
                                            <img style="height: 600px; width: 100%;" src="<?= base_url('product_images/' . $product_image) ?>">
                                        </div>
                                        <?php
                                        $i++;
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <br>
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2><?= $product->product_name; ?></h2>
                                <h3>Varian : <?= $product->variant_name; ?></h3>
                                <h3 id="QTY">
                                    Kuatntitas : <?= number_format($product->qty, 0, ",", "."); ?>
                                </h3>
                                <h3 id="harga">
                                    Harga : Rp. <?= number_format($product->price, 0, ",", "."); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-5 col-12">
                <div class="order-details">
                    <!-- Shopping Summery -->
                    <table class="table table-striped shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th class="text-center" colspan="3">Detail Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No. Pembelian</td>
                                <td>:</td>
                                <td><?= $invoice->invoice ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><?= $invoice->name ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembelian</td>
                                <td>:</td>
                                <td><?= date('d-m-Y', strtotime($invoice->order_date)) ?></td>
                            </tr>
                            <tr>
                                <td>No. Handphone</td>
                                <td>:</td>
                                <td><?= $invoice->phone ?></td>
                            </tr>
                            <tr>
                                <td>Kurir/Service/Cost</td>
                                <td>:</td>
                                <td><?= $invoice->courier ?> / <?= $invoice->service ?> / Rp. <?= number_format($invoice->cost_courier, 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $invoice->address ?></td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td>:</td>
                                <td>Rp. <?= number_format($invoice->grand_total, 0, ",", "."); ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?= $invoice->status ?></td>
                            </tr>
                            <tr>
                                <td>Bayar Sekarang</td>
                                <td>:</td>
                                <td>
                                    <button type="button" class="btn btn-primary text-white" onclick="payment('<?= $invoice->snap_token ?>')">Bayar Sekarang</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("page_script") ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zX2KEncmiPWpEN0p"></script>
<script>
    function payment(snap_token) {

        window.snap.pay(snap_token, {
            onSuccess: function() {
                window.location = `/eshop-customer/order/<?= $invoice->snap_token ?>/status/success/update`;
            },
            onPending: function() {
                window.location = `/eshop-customer/order/<?= $invoice->snap_token ?>/status/pending/update`;
            },
            onError: function() {
                window.location = `/eshop-customer/order/<?= $invoice->snap_token ?>/status/error/update`;
            }
        })
    }
</script>
<?= $this->endSection() ?>