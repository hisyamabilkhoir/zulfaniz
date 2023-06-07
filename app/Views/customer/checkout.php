<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="post" action="<?= base_url('/eshop-customer/checkout/process') ?>">
            <div class="row">
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
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Halaman Checkout</h2>
                        <p>Silahkan Masukkan identitas pengiriman untuk segera melakukan checkout</p>
                        <!-- Form -->
                        <input type="hidden" name="weight" value="<?= $weightTotal ?>">
                        <input type="hidden" name="grand_total" value="<?= $grandTotal ?>">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Nama Lengkap<span>*</span></label>
                                    <input type="text" name="name" placeholder="Nama" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="Email" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>No. Handphone<span>*</span></label>
                                    <input type="number" name="phone" placeholder="No Handphone" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Provinsi<span>*</span></label>
                                    <select name="province" id="province">
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        <?php foreach ($provinces as $key => $value) : ?>
                                            <option value="<?= (int)$value['province_id'] ?>"><?= $value['province'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group" id="city">
                                    <label>Kota<span>*</span></label>
                                    <select name="city" id="select_city">
                                        <option value="" disabled selected>Pilih provinsi terlebih dahulu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12" id="courier">
                            </div>
                            <div class="col-lg-12 col-md-12 col-12" id="cost">
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Alamat<span>*</span></label>
                                    <textarea style="background-color: #f6f7fb; border: none;" name="address" placeholder="  Masukan alamat . . ." required></textarea>
                                </div>
                            </div>
                        </div>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Total</h2>
                            <div class="content">
                                <ul>
                                    <li>Sub Total<span>Rp. <?= number_format($grandTotal, 0, ",", "."); ?></span></li>
                                    <li>(+) Pengiriman<span id="shipping">Rp. 0</span></li>
                                    <li class="last">Total<span id="grandTotal">Rp. <?= number_format($grandTotal, 0, ",", "."); ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <button type="submit" class="btn">Proses Checkout</button>
                                </div>
                            </div>
                        </div>
                        <!--/ End Button Widget -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="text/javascript">
    $("#province").change(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('eshop-customer/get-cities') ?>',
            method: "post",
            data: {
                provinceId: $('#province').val(),
            },
            success: function(response) {
                // $('#select_city').html(response);
                $('#city').html(response);
            }
        });
    });

    function checkKurir(name) {
        $.ajax({
            url: '<?= base_url('eshop-customer/get-cost') ?>',
            method: "post",
            data: {
                cityId: $('#select_city').val(),
                weight: <?= $weightTotal ?>,
                courier: name,
            },
            success: function(response) {
                // $('#select_city').html(response);
                $('#cost').html(response);
            }
        });
    }

    function addCourier(value) {
        let reverse = value.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        let harga = ribuan.join('.').split('').reverse().join('');

        $('#shipping').html(`Rp. ${harga}`);

        let grandTotal = <?= $grandTotal ?> + value;

        grandTotal = grandTotal.toString().split('').reverse().join(''),
            ribuan1 = grandTotal.match(/\d{1,3}/g);
        grandTotal = ribuan1.join('.').split('').reverse().join('');

        $('#grandTotal').html(`Rp. ${grandTotal}`);
    }
</script>
<?= $this->endSection() ?>