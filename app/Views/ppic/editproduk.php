<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<hr class="">
<form action="<?= base_url(authHelpers::getRole() . '/edit'); ?>" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_bahan" value="<?= $data['id_bahan']; ?>">
    <!-- Text input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="id_bahan">ID Bahan</label>
        <input type="text" id="id_bahan" class="form-control col-lg-6" name="id_bahan" value="<?= $data['id_bahan']; ?>" required autofocus disabled/>
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="warna">warna</label>
        <input type="text" id="warna" class="form-control col-lg-6" name="warna" value="<?= $data['warna']; ?>" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="stok">Stok</label>
        <input type="number" id="stok" class="form-control col-lg-6" name="stok" value="<?= $data['stok']; ?>" required />
    </div>

    <div class="form-group mb-4">
        <label for="jenis"></label>
        <select class="form-control col-lg-6" id="jenis" name="jenis" required>
            <option disabled value="">Pilih Jenis bahan</option>
            <?php foreach ($enum as $d) : ?>
            <option value='<?= $d ?>'<?= $data['jenis'] === $d ? "selected" : ''; ?>><?= $d ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-light">Reset</button>
</form>
<?= $this->endSection() ?>