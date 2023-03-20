<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Pengelolaan Pembelian</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/orders'); ?>">Pembelian</a>
        </li>
    </ul>
</div>
<?= $this->endSection() ?>



<?= $this->section("page_content") ?>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Produk</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="bg-info text-white text">Nama Produk</th>
                                    <th class="bg-info text-white text">Varian</th>
                                    <th class="bg-info text-white text">Kuantitas</th>
                                    <th class="bg-info text-white text">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><?= $product->product_name ?></td>
                                        <td><?= $product->variant_name ?></td>
                                        <td class="text-center"> <?= number_format($product->qty, 0, ",", "."); ?></td>
                                        <td>Rp. <?= number_format($product->price, 0, ",", "."); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Pembelian</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="3" class="bg-info text-white text-center">Detail Pembelian</th>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>