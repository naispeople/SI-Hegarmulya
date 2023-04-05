<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<hr class="">
<form action="<?= base_url(authHelpers::getRole() . '/edit'); ?>" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
    <!-- Text input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="nama">Nama</label>
        <input type="text" id="nama" class="form-control col-lg-6" name="nama" required autofocus value="<?= $data['nama']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Email</label>
        <input type="text" id="email" class="form-control col-lg-6" name="email" required autofocus value="<?= $data['email']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="username">Username</label>
        <input type="text" id="username" class="form-control col-lg-6" name="username" required autofocus value="<?= $data['username']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" class="form-control col-lg-6" name="password" />
    </div>
    <div class="form-group mb-4">
        <label for="OptionFieldName">Jabatan</label>
        <select class="form-control col-lg-6" id="OptionFieldName" name="jabatan">
            <option disabled>Pilih Role</option>
            <option value="admin" <?= $data['jabatan'] === "admin" ? "selected" : ''; ?>>admin</option>
            <option value="dyeing" <?= $data['jabatan'] === "dyeing" ? "selected" : ''; ?>>dyeing</option>
            <option value="printing" <?= $data['jabatan'] === "printing" ? "selected" : ''; ?>>printing</option>
            <option value="finishing" <?= $data['jabatan'] === "finishing" ? "selected" : ''; ?>>finishing</option>
        </select>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-light">Reset</button>
</form>
<?= $this->endSection() ?>