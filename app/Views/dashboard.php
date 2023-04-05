<?php

use App\Helpers\authHelpers;
?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>

<!-- Content Row -->
<div class="row my-4">
    <?php if (authHelpers::getRole() != 'admin') :
        foreach ($dataMonitoring as $data) : ?>
            <!-- Monitoring Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-<?= $data['card-color']; ?> shadow h-100 py-2">
                    <div class="card-body" <?php if ($data['card-name'] !='Pesanan') { echo 'id="card-modal" data-toggle="modal" data-target="#Modal" data-name="'.$data['card-name'].'"';} ?> >
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-<?= $data['card-color']; ?> text-uppercase mb-1">
                                    <?= $data['card-name']; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['card-data']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-<?= $data['card-icon']; ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;

    else : foreach ($dataMonitoring as $data) : ?>
            <!-- Monitoring Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-<?= $data['card-color']; ?> shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-<?= $data['card-color']; ?> text-uppercase mb-1">
                                    <?= $data['card-name']; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['card-data']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-<?= $data['card-icon']; ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach;
    endif; ?>
</div>

<?php if (authHelpers::getRole() != 'admin') : ?>
    <div class="row my-4">
        <?php foreach ($dataChart as $data) : ?>
            <div class="col-xl-12">
                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $data['chart-name']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="<?= $data['chart-id']; ?>"></canvas>
                        </div>
                        <hr>
                        <?= $data['chart-desc']; ?>
                    </div>
                </div>
            </div>
            <script>
                var Data<?= $data['chart-id']; ?> = JSON.parse(`<?= $data['chart-data']; ?>`);
            </script>
           
        <?php endforeach;?>
    </div>
<?php endif; ?>

<!-- Modal Details -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header card-header py-3  d-flex align-middle justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    Detail <span id="name"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalDetails">

            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('div #card-modal').on('click', function() {
            const name = $(this).data('name');
            $('#name').html("Produksi " + name);

                var baseUrl = '<?php echo base_url('getDetails'); ?>';
                console.log(name);
                // Call Modal
                $.ajax({
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    url: baseUrl,
                    type: 'get',
                    data: {
                        name: name
                    },
                    success: function(response) {
                        $('#ModalDetails').html(response);
                        $('#Modal').show();
                    },
                    error: function(response) {
                        alert("error" + JSON.stringify(response));
                    }
                });

        });
    });
</script>
<?= $this->endSection() ?>