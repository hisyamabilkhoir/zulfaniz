<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
<h5 class="text-white op-7 mb-2">Halaman Dashboard</h5>
<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center bg-primary text-white">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category text-primary">Pendapatan Bulan Ini</p>
                                <h4 class="card-title">Rp. <?= number_format($totalCurrentMonth->grand_total, 0, ",", "."); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center bg-warning text-white">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category text-warning">Pendapatan Tahun Ini</p>
                                <h4 class="card-title">Rp. <?= number_format($totalCurrentYear->grand_total, 0, ",", "."); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center bg-success text-white">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category text-success">Semua Pendapatan</p>
                                <h4 class="card-title">Rp. <?= number_format($total->grand_total, 0, ",", "."); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Pembelian Terbaru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>No. Pembelian</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $d = 0;
                                foreach ($invoices as $invoice) {
                                    $d++;
                                ?>
                                    <tr>
                                        <td class='text-center'><?= $d ?></td>
                                        <td><?= $invoice->name ?></td>
                                        <td><?= $invoice->invoice ?></td>
                                        <td><?= date('d-m-Y', strtotime($invoice->order_date)) ?></td>
                                        <td>Rp. <?= number_format($invoice->grand_total, 0, ",", "."); ?></td>
                                        <td><?= $invoice->status ?></td>
                                        <td class='text-center'>
                                            <a href="<?= base_url('eshop-admin/order/' . $invoice->id); ?>" class="btn btn-info btn-sm text-white">
                                                <i class="fa fa-info"></i>
                                            </a>
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
<?= $this->endSection() ?>