<label>Layanan Kurir<span style="color: #ff2c18;"> *</span></label>
<br>
<div class="m-sm-4">
    <?php foreach ($costs as $value) : ?>
        <div class="form-check form-check-inline w-25">
            <input type="hidden" name="service" value="<?= $value['service'] ?>">
            <input class="form-check-input" type="radio" name="cost" onclick="addCourier(<?= $value['cost'][0]['value'] ?>)" id="<?= $value['service'] ?>" value="<?= $value['cost'][0]['value'] ?>" required>
            <label class="form-check-label" for="<?= $value['service']  ?>"><?= $value['service'] ?></label>
            <label class="form-check-label" for="<?= $value['service']  ?>">Rp. <?= number_format($value['cost'][0]['value'], 0, ",", "."); ?> - <?= str_contains($value['cost'][0]['etd'], 'HARI') ?  $value['cost'][0]['etd'] : $value['cost'][0]['etd'] . ' HARI' ?> </label>
        </div>
    <?php endforeach; ?>
</div>