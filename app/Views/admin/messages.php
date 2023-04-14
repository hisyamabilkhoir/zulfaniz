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
    </ul>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        Tanggal : <small id="detailDate"></small>, <small id="detailTime"></small>
                    </div>
                    <div class="col-md-6">
                        Status : <small id="detailStatus"></small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detailName"> Nama </label>
                            <input class="form-control" type="text" id="detailName" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detailSubject"> Subject </label>
                            <input class="form-control" type="text" id="detailSubject" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detailEmail"> Email </label>
                            <input class="form-control" type="email" id="detailEmail" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="detailPhone"> Phone </label>
                            <input class="form-control" type="text" id="detailPhone" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="detailMessage">Pesan</label>
                            <textarea class="form-control" id="detailMessage" rows="10" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <div class="float-right d-inline">
                    <button type="buttom" class="btn btn-light d-inline">Balas Menggunakan : </button>
                    <form class="d-inline" action="<?= base_url('eshop-admin/message/whatsapp') ?>" method="post">
                        <input type="hidden" name="id" id="detailID">
                        <button type="submit" class="btn btn-success">WhatsApp</button>
                    </form>
                    <form class="d-inline" action="<?= base_url('eshop-admin/message/gmail') ?>" method="post">
                        <input type="hidden" name="id" id="detailIDGmail">
                        <button type="submit" class="btn btn-warning">Gmail</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Pesan</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Subjek</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($messages as $message) {
                                    $d++;
                                ?>
                                    <tr>
                                        <td class='text-center'><?= $d ?></td>
                                        <td><?= $message->name ?></td>
                                        <td><?= $message->subject ?></td>
                                        <td><?= date('d-m-Y', strtotime($message->date)) ?>, <?= $message->time; ?></td>
                                        <td>
                                            <?php if ($message->status == 1) : ?>
                                                Menunggu Balasan
                                            <?php else : ?>
                                                Terbalas
                                            <?php endif; ?>
                                        </td>
                                        <td class='text-center'>
                                            <button onclick="detail('<?= $message->id ?>','<?= $message->name ?>', '<?= $message->subject ?>','<?= $message->email ?>','<?= $message->phone ?>','<?= trim(preg_replace('/\r?\n|\r/', '\n', $message->message)); ?>','<?= date('d-m-Y', strtotime($message->date)) ?>','<?= $message->time ?>','<?= $message->status ?>')" title="Detail" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDetail">
                                                <i class="fa fa-info"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script>
    function detail(id, name, subject, email, phone, message, date, time, status) {
        $("#detailID").val(id)
        $("#detailIDGmail").val(id)
        $("#detailName").val(name)
        $("#detailSubject").val(subject)
        $("#detailEmail").val(email)
        $("#detailPhone").val(phone)
        $("#detailMessage").val(message)
        $("#detailDate").html(date)
        $("#detailTime").html(time)
        if (status == 1) {
            $("#detailStatus").html("Menunggu Balasan");
        } else {
            $("#detailStatus").html("Terbalas");
        }
    }
</script>
<?= $this->endSection() ?>