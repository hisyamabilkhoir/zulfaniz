<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>No. Pembelian</th>
                            <th>Nama Lengkap</th>
                            <th class="text-center">Tanggal Pembelian</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center"><i class="ti-menu-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoices as $invoice) : ?>
                            <tr data-id="<?= $invoice->id; ?>">
                                <td class="invoice text-center" data-title="invoice"><span><?= $invoice->invoice ?></span></td>
                                <td class="name text-center" data-title="name"><span><?= $invoice->name ?></span></td>
                                <td class="date text-center" data-title="date"><span><?= date('d-m-Y', strtotime($invoice->order_date)) ?></span></td>
                                <td class="price text-center" data-title="Price">Rp. <span> <?= number_format($invoice->grand_total, 0, ",", ".") ?></span></td>
                                <td class="status text-center" data-title="status"><span> <?= $invoice->status ?></span></td>
                                <td class="button text-center" data-title="order-detail">
                                    <a class="button bg-info text-white p-2" href="<?= base_url("/eshop-customer/order-history/$invoice->snap_token") ?>">
                                        <i class="ti-menu-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>