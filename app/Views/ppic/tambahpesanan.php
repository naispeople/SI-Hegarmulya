<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<hr class="">
<form action="<?= base_url(authHelpers::getRole() . '/tambahpesanan'); ?>" method="POST">
    <?= csrf_field(); ?>
    <!-- Text input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="id_pesanan">ID Pesanan</label>
        <input type="text" id="id_pesanan" class="form-control col-lg-6" name="id_pesanan" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="nama_pemesan">Nama Pemesan</label>
        <input type="text" id="nama_pemesan" class="form-control col-lg-6" name="nama_pemesan" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="alamat">Alamat</label>
        <input type="text" id="alamat" class="form-control col-lg-6" name="alamat" required />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="kontak">Kontak</label>
        <input type="text" id="kontak" class="form-control col-lg-6" name="kontak" required />
    </div>
    <div class="form-group mb-4">
        <label for="id_bahan">bahan</label><br>
        <select class="form-control col-lg-6" id="id_bahan" name="id_bahan" required>
            <option disabled selected value="">Pilih bahan</option>
            <?php foreach ($data as $d) : ?>
            <option value='<?= $d['id_bahan'] ?>'><?= $d['warna']?> - <?= $d['jenis'] ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="jumlah">Jumlah</label>
        <input type="text" id="jumlah" class="form-control col-lg-6" name="jumlah" required />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="tgl_pesan">Tanggal Pesanan</label>
        <input type="date" id="tgl_pesan" class="form-control col-lg-6" name="tgl_pesan" required />
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-light">Reset</button>
</form>

<script>
     $(document).ready(function () {
        $("#id_bahan").select2({
          theme: 'bootstrap4',
        });
     });
</script>
<?= $this->endSection() ?>