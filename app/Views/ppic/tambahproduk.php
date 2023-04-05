<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<hr class="">
<form action="<?= base_url(authHelpers::getRole() . '/tambahproduk'); ?>" method="POST">
    <?= csrf_field(); ?>
    <!-- Text input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="id_bahan">ID Bahan</label>
        <input type="text" id="id_bahan" class="form-control col-lg-6" name="id_bahan" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="warna">warna</label>
        <input type="text" id="warna" class="form-control col-lg-6" name="warna" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="stok">Stok</label>
        <input type="number" id="stok" class="form-control col-lg-6" name="stok" required />
    </div>

    <div class="form-group mb-4">
        <label for="jenis">Jenis bahan</label><br>
        <select class="form-control col-lg-6 " id="jenis" name="jenis" required>
            <option disabled selected value="">Pilih Jenis bahan</option>
            <?php foreach ($data as $d) : ?>
            <option value='<?= $d ?>'><?= $d ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-light">Reset</button>
</form>

<script>
     $(document).ready(function () {
        $("#jenis").select2({
          theme: 'bootstrap4',
        });
     });
</script>

<?= $this->endSection() ?>