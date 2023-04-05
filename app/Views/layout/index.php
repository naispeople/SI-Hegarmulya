<?= $this->include('layout/header') ?>
<?= $this->include('layout/topbar') ?>
<section class="px-5">
    <h1 class="text-capitalize"><?= $pageName; ?></h1>
    <?= $this->renderSection('content') ?>
</section>

<?= $this->include('layout/footer') ?>