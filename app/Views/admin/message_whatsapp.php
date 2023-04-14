<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Pesan</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a style="color: white;" href="<?= base_url('eshop-admin/dashboard'); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="<?= base_url('eshop-admin/messages'); ?>">Pesan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow text-white"></i>
        </li>
        <li class="nav-item">
            <a style="color: white;" href="#">Balas Menggunakan WhatsApp</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Pesan</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            Tanggal : <small><?= date('d-m-Y', strtotime($message->date)) ?></small>, <small><?= $message->time; ?></small>
                        </div>
                        <div class="col-md-6">
                            <?php
                            if ($message->status == 1) {
                                $status = "Menuggu Balasan";
                            } else {
                                $status = "Terbalas";
                            }
                            ?>
                            Status : <small><?= $status; ?></small>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Nama </label>
                                <input class="form-control" type="text" name="name" id="name" value="<?= $message->name; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject"> Subject </label>
                                <input class="form-control" type="text" name="subject" value="<?= $message->subject; ?>" id="subject" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <input class="form-control" type="email" name="email" value="<?= $message->email; ?>" id="email" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"> Phone </label>
                                <input class="form-control" type="text" name="phone" value="<?= $message->phone; ?>" id="phone" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">Pesan</label>
                                <textarea class="form-control" name="message" id="message" rows="10" readonly><?= $message->message; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Kirim Balasan Pesan</h4>
                    </div>
                </div>
                <form action="<?= base_url('eshop-admin/message/whatsapp/reply') ?>" method="post" id="form_reply" target="_blank">
                    <input type="hidden" name="id" value="<?= $message->id; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reply_message">Pesan balasan</label>
                                    <textarea class="form-control" name="reply_message" id="reply_message" placeholder="Masukan pesan balasan . . ." rows="17"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="<?= base_url('eshop-admin/messages') ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script>
    document.querySelector("#form_reply").addEventListener("submit", function(e) {
        // e.preventDefault();
        setTimeout(() => {
            // window.reload(true);
            // window.location.reload(true);
            window.location.href = "<?= base_url('eshop-admin/message/gmail/reply/' . $message->id) ?>"
        }, 1000);
    })
</script>
<?= $this->endSection() ?>