<?= $this->extend("customer/template") ?>

<?= $this->section("page_content") ?>
<div class="shopping-cart section">
    <div class="container">
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
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUK</th>
                            <th>NAMA (VARIAN)</th>
                            <th class="text-center">HARGA</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">SUB TOTAL</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $total = 0;
                        ?>
                        <?php foreach ($carts as $cart) : ?>
                            <?php
                            $no++;
                            $product_image = $db->query("select * from product_images where product_id ='" . $cart->product_id . "'");
                            $data_product_image = $product_image->getFirstRow();

                            $product_variant = $db->query("select * from product_variants where id ='" . $cart->product_variant_id . "'");
                            $data_product_variant = $product_variant->getFirstRow();

                            $product = $db->query("select * from products where id ='" . $cart->product_id . "'");
                            $data_product = $product->getFirstRow();

                            ?>
                            <tr data-id="<?= $cart->id; ?>">
                                <td class="image" data-title="No"><img style="height: 100px; width: 100px;" src="<?= base_url('product_images/' . $data_product_image->product_image); ?>"></td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name"><a href="<?= base_url('product/detail/' . $data_product->slug); ?>"><?= $data_product->title; ?> (<?= $data_product_variant->size; ?>)</a></p>
                                    <p class="product-des"><?= $data_product->content; ?></p>
                                </td>
                                <td class="price" data-title="Price"><span>Rp. <?= number_format($cart->price, 0, ",", ".") ?></span></td>
                                <td class="qty" data-title="Qty">
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quantity[<?= $no; ?>]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quantity[<?= $no; ?>]" id="quantity" class="input-number quantity update-cart" data-min="1" data-max="<?= $data_product_variant->stock; ?>" value="<?= $cart->quantity; ?>">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quantity[<?= $no; ?>]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="total-amount" data-title="Total">
                                    <?php
                                    $subTotal = $cart->quantity * $cart->price;
                                    ?>
                                    <span>Rp. <?= number_format($subTotal, 0, ",", ".") ?></span>
                                    <?php
                                    $total += $subTotal;
                                    ?>
                                </td>
                                <td class="action remove-from-cart" data-title="Remove"><i class="ti-trash remove-icon"></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">

                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li style="font-weight: bold;">Total<span>Rp. <?= number_format($total, 0, ",", ".") ?></span></li>
                                    <li class="last"></li>
                                </ul>
                                <div class="button5">
                                    <a href="<?= base_url('eshop-customer/checkout') ?>" class="btn">Checkout</a>
                                    <a href="<?= base_url('products') ?>" class="btn">Lanjut Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="text/javascript">
    $(".update-cart").change(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '<?= base_url('eshop-customer/update-item-cart') ?>',
            method: "post",
            data: {
                cart_id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Yakin ingin hapus barang dalam keranjang ?")) {
            $.ajax({
                url: '<?= base_url('eshop-customer/remove-item-cart') ?>',
                method: "post",
                data: {
                    cart_id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>