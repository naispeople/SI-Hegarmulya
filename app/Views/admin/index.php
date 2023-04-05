<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>
<h1>Selamat datang <?= session()->nama; ?> - dashboard admin</h1>

<?= $this->endSection() ?>