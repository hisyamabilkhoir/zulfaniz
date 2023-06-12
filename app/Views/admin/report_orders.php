<?= $this->extend("admin/template") ?>

<?= $this->section("page_title") ?>
<div class="page-header">
    <h4 class="page-title" style="color: white;">Laporan Penjualan</h4>
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
            <a style="color: white;" href="<?= base_url('eshop-admin/report-orders'); ?>">Laporan Penjualan</a>
        </li>
    </ul>
</div>

<?= $this->endSection() ?>

<?php
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>

<h2 class="text-white pb-2 fw-bold">Laporan</h2>
<h5 class="text-white op-7 mb-2">Laporan Penjualan</h5>


<?= $this->section("page_content") ?>
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card full-height">
            <div class="card-header">
                <h5 class="card-title">
                    Generate Laporan
                </h5>
            </div>
            <form action="<?= base_url('eshop-admin/report-orders-print') ?>" method="get" target="_blank">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Pilihan Periode</label>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="dateperiod">
                                            <input class="form-check-input radio-period" checked type="radio" name="period" id="dateperiod" value="datePeriod">
                                            Tanggal
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="daterangeperiod">
                                            <input class="form-check-input radio-period" type="radio" name="period" id="daterangeperiod" value="dateRangePeriod">
                                            Antara Tanggal
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="monthperiod">
                                            <input class="form-check-input radio-period" type="radio" name="period" id="monthperiod" value="monthPeriod">
                                            Bulan
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="yearperiod">
                                            <input class="form-check-input radio-period" type="radio" name="period" id="yearperiod" value="yearPeriod">
                                            Tahun
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4" id='periodContainer'>
                                    <input type='date' name='date' value="<?= date('Y-m-d') ?>" class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button type='submit' class='btn btn-block btn-info'>
                                    <i class='fa fa-print'></i>
                                    Cetak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="text/javascript">
    $("#dateperiod").change(function() {
        if ($(this).is(':checked')) {
            $("#periodContainer").html(`
            <input type='date' name='date' value='<?= date('Y-m-d') ?>' class='form-control'>
            `)
        }
    })
    $("#daterangeperiod").change(function() {
        if ($(this).is(':checked')) {
            $("#periodContainer").html(`
            <div class='row'>
                <div class='col-md-6'>
                <input type='date' name='date_begin' value='<?= date('Y-m-d', strtotime('-1 days')) ?>' class='form-control'>
                </div>
                <div class='col-md-6'>
                <input type='date' name='date_end' value='<?= date('Y-m-d') ?>' class='form-control'>
                </div>
            </div>
            `)
        }
    })
    $("#monthperiod").change(function() {
        if ($(this).is(':checked')) {
            $("#periodContainer").html(
                `
                <?php
                echo "<div class='row'>";
                echo "<div class='col-md-6'>";
                echo "<select name='month' class='form-control'>";
                $m = 0;
                foreach ($months as $month) {
                    $m++;
                    if ($m == date('m')) {
                        echo "<option value='$m' selected>$month</option>";
                    } else {
                        echo "<option value='$m'>$month</option>";
                    }
                }
                echo '</select>';
                echo '</div>';
                echo "<div class='col-md-6'>";
                echo "<select name='year' class='form-control'>";
                for ($y = 2000; $y <= date('Y') + 25; $y++) {
                    if ($y == date('Y')) {
                        echo "<option value='$y' selected>$y</option>";
                    } else {
                        echo "<option value='$y'>$y</option>";
                    }
                }
                echo '</select>';
                echo '</div>';
                echo '</div>';
                ?>
                `
            )
        }
    })
    $("#yearperiod").change(function() {
        if ($(this).is(':checked')) {
            $("#periodContainer").html(
                `
                <?php
                echo "<select name='year' class='form-control'>";
                for ($y = 2000; $y <= date('Y') + 25; $y++) {
                    if ($y == date('Y')) {
                        echo "<option value='$y' selected>$y</option>";
                    } else {
                        echo "<option value='$y'>$y</option>";
                    }
                }
                echo '</select>';
                ?>
                `
            )
        }
    })
</script>
<?= $this->endSection() ?>