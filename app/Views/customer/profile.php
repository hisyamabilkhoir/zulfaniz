<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<section class="midium-banner">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="single-banner">
                    <div class="row mt-5">
                        <div class="col-md-4 col-lg-4 col-12">
                            <div class="card" style="border-radius: 20px 20px 10px 10px; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                                <img class="card-img-top" style="border-radius: 20px 20px 10px 10px;" src="<?= base_url('customer_default.png') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text text-dark">Besar file: maksimum 10.000.000 bytes (10 Megabytes). Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                                    <a href="#" class="w-100 btn btn-primary">Pilih Foto</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12 col-md-8">
                            <div class="card" style="box-shadow: 0 5px 10px rgba(0,0,0,.2); border-radius: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title">Biodata Diri</h5>
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?= config("LoginCustomer")->customerName; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?= config("LoginCustomer")->customerEmail; ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Handphone</td>
                                            <td>:</td>
                                            <td><?= config("LoginCustomer")->customerPhone; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= config("LoginCustomer")->customerAddress; ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <div>
                                        <a href="<?= base_url('eshop-customer/profile/edit') ?>" class="card-link" style="margin-top: -25px;">Ubah Data</a>
                                        <a href="<?= base_url('eshop-customer/password/edit') ?>" class="card-link float-right" style="margin-top: -10px;">Reset Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?= $this->endSection() ?>