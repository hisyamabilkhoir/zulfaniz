<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12">
                    <?php if (session('msg_status')) : ?>
                        <div class="alert mt-5 alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
                            <?= session('msg'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="form-main">
                        <div class="title">
                            <h4>Hubungi Kami !</h4>
                            <h3>Tuliskan Pesan Kamu</h3>
                        </div>
                        <form class="form" method="post" action="<?= base_url('contact/send') ?>">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Nama<span>*</span></label>
                                        <input name="name" type="text" required placeholder="Masukan nama . . .">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Subjek<span>*</span></label>
                                        <input name="subject" type="text" required placeholder="Masukan subjek . . .">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input name="email" type="email" required placeholder="Masukan email . . .">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>No. Handphone<span>*</span></label>
                                        <input name="phone" type="text" required placeholder="Masukan nomor handphone . . .">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group message">
                                        <label>Pesan<span>*</span></label>
                                        <textarea name="message" required placeholder="Masukan pesan . . ."></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn ">KIRIM</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="single-head">
                        <div class="single-info">
                            <i class="fa fa-phone"></i>
                            <h4 class="title">Hubungi Sekarang:</h4>
                            <ul>
                                <li>+62 859 7372 9267</li>
                            </ul>
                        </div>
                        <div class="single-info">
                            <i class="fa fa-envelope-open"></i>
                            <h4 class="title">Email:</h4>
                            <ul>
                                <li><a href="mailto:zulfanizbusiness@gamil.com">zulfanizbusiness@gamil.com</a></li>
                            </ul>
                        </div>
                        <div class="single-info">
                            <i class="fa fa-location-arrow"></i>
                            <h4 class="title">Alamat:</h4>
                            <ul>
                                <li>Jalan Pahlawan No. 17</li>
                                <li>Desa Dawuan</li>
                                <li>Kec. Tengah Tani, Kab. Cirebon</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>