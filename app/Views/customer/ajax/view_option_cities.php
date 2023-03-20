<label>Kota<span>*</span></label>
<select name="city" id="select_city" style="display: none;">
    <option value="" disabled="" selected="">Pilih Kota</option>
    <?php foreach ($cities as $key => $value) : ?>
        <option value="<?= $value['city_id'] ?>"><?= $value['city_name'] ?></option>
    <?php endforeach; ?>
</select>
<div class="nice-select" tabindex="0"><span class="current">Pilih Kota</span>
    <ul class="list">
        <?php foreach ($cities as $key => $value) : ?>
            <li data-value="<?= $value['city_id'] ?>" class="option"><?= $value['type'] ?> <?= $value['city_name'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<script>
    $("#select_city").change(function(e) {
        e.preventDefault();
        $('#courier').html(`
        <label>Kurir<span style="color: #ff2c18;"> *</span></label>
        <br>
        <div class="m-sm-4">
        <div class="form-check form-check-inline w-25">
        <input class="form-check-input" onclick="checkKurir('jne')" type="radio" name="courier" id="jne" value="jne">
        <label class="form-check-label" for="jne">JNE</label>
        </div>
        <div class="form-check form-check-inline w-25">
        <input class="form-check-input" onclick="checkKurir('tiki')" type="radio" name="courier" id="tiki" value="tiki">
        <label class="form-check-label" for="tiki">Tiki</label>
        </div>
        <div class="form-check form-check-inline w-25">
        <input class="form-check-input" onclick="checkKurir('pos')" type="radio" name="courier" id="pos" value="pos">
        <label class="form-check-label" for="pos">POS</label>
        </div>
        </div>
        `);
    });
</script>