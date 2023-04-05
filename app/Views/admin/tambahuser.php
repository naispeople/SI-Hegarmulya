<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<hr class="">
<form action="<?= base_url(authHelpers::getRole() . '/tambahuser'); ?>" method="POST">
    <?= csrf_field(); ?>
    <!-- Text input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="nama">Nama</label>
        <input type="text" id="nama" class="form-control col-lg-6" name="nama" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Email</label>
        <input type="text" id="email" class="form-control col-lg-6" name="email" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="username">Username</label>
        <input type="text" id="username" class="form-control col-lg-6" name="username" required autofocus />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" class="form-control col-lg-6" name="password" required />
    </div>
    <div class="form-group mb-4">
        <label for="jabatan">Jabatan</label>
        <select class="form-control col-lg-6" id="jabatan" name="jabatan" required>
            <option disabled selected value="">Pilih Jabatan</option>
            <option value="admin">Admin</option>
            <option value="manajer">Manajer Produksi</option>
            <option value="ppic">PPIC</option>
            <option value="dyeing">Kepala Bagian Dyeing</option>
            <option value="printing">Kepala Bagian Printing</option>
            <option value="finishing">Kepala Bagian Finishing</option>     
        </select>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-light">Reset</button>
</form>


<?= $this->endSection() ?>