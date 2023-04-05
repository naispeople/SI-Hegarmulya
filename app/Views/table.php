<?php
// $tableName = 'Tables Name Here';
// $tableHead = ['id_user', 'Username', 'Role'];
// $tableData = [
//     ['id_user' => 'A001', 'username' => 'admin', 'role' => 'admin'],
//     ['id_user' => 'O001', 'username' => 'owner', 'role' => 'owner']
// ];
// $dataColumn = ['id_user', 'username', 'role'];

use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;

?>
<?= $this->extend('layout/index') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('msg')) : ?>
    <div class='<?= session()->getFlashdata('class'); ?>'>
        <?= session()->getFlashdata('msg'); ?>
    </div>
<?php endif;

$estimasi = 0;
$dt = Date('Y-m-d');
if (isset($pesanan)) {

    foreach ($pesanan as $p) {
        $estimasi += $p['jumlah'];
    }
    $estimasi /= 2500;
}

?>


<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3  d-flex align-middle justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <?= $tableName; ?>
        </h6>
        <?php if ($tambah == 'kategori') {
            echo '<button type="button" id="tambah_kategori" class="btn btn-primary" data-toggle="modal"  data-target="#Modalx">Tambah</button>';
        } elseif ($tambah !== '#') {
            echo '
        <a href=' . base_url(authHelpers::getRole() . '/' . $tambah) . ' class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        ';
        } ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <?php foreach ($tableHead as $head) : ?>
                            <th><?= $head; ?></th>
                        <?php endforeach;
                        if ($menu == 'produksi') {
                            echo ' <th>Status</th>';
                        }
                        if ($menu !== 'barangmasuk' and $menu !== 'barangkeluar') {
                            echo '
                        <th>Action</th>
                        ';
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($tableData as $data) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <?php foreach ($dataColumn as $column) : ?>
                                <td><?= $data[$column]; ?></td>
                            <?php
                            endforeach;
                            if ($menu == 'produksi') {
                                echo  '<td class="text-center align-middle">' . utilityHelpers::Status($data['status']) . '</td>';
                            } ?>
                            <?php if ($menu == 'pesanan' and authHelpers::getRole() != 'manajer') : ?>
                                <td class="d-flex align-middle">
                                    <a href="<?= base_url(authHelpers::getRole() . "/edit_pesanan//" . $data[$dataColumn[0]]); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <form action="<?= base_url(authHelpers::getRole() . "/delete_pesanan"); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="<?= $dataColumn[0]; ?>" value="<?= $data[$dataColumn[0]]; ?>">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                            <?php
                            elseif (authHelpers::getRole() == 'manajer' and $menu == 'pesanan') : ?>

                                <td class="d-flex align-middle">
                                    <button class="btn btn-primary btn-edit" id="btnEdit" data-toggle="modal" data-target="#ModalEdit" data-id_pesanan="<?= $data[$dataColumn[0]]; ?>" data-id_bahan="<?= $data['id_bahan']; ?>">
                                        <i class="fas fa-arrow-up"></i></button>
                                </td>

                                <?php
                            elseif ($menu == 'produksi' and authHelpers::getRole() != 'manajer') :
                                if (authHelpers::getRole() == 'dyeing') :
                                    if ($data['status'] == 0) {
                                ?>
                                        <td class="d-flex align-middle">
                                            <button class="btn btn-primary btn-edit" id="btnProses" data-toggle="modal" data-target="#ModalProses" data-id_produksi="<?= $data[$dataColumn[0]]; ?>">
                                                <i class="fas fa-arrow-up"></i></button>
                                            <pre> </pre>
                                        </td>
                                    <?php ;
                                    } elseif ($data['status'] == 1) {
                                    ?>
                                        <td>
                                            <a href="<?= base_url(authHelpers::getRole() . "/edit//" . $data[$dataColumn[0]]); ?>" class="btn btn-success mr-1"><i class="fas fa-check"></i></a>
                                        </td>
                                    <?php ;
                                    } else {
                                    ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-light">Selesai</span></h5>
                                        </td>
                                    <?php
                                    }

                                elseif (authHelpers::getRole() == 'printing') :
                                    if ($data['status'] == 2) {
                                    ?>
                                        <td class="d-flextext-center">
                                            <button class="btn btn-primary btn-edit" id="btnProses" data-toggle="modal" data-target="#ModalProses" data-id_produksi="<?= $data[$dataColumn[0]]; ?>">
                                                <i class="fas fa-arrow-up"></i></button>
                                            <pre> </pre>
                                        </td>
                                    <?php ;
                                    } elseif ($data['status'] == 3) {
                                    ?>
                                        <td>
                                            <a href="<?= base_url(authHelpers::getRole() . "/edit//" . $data[$dataColumn[0]]); ?>" class="btn btn-success mr-1"><i class="fas fa-check"></i></a>
                                        </td>
                                    <?php ;
                                    } elseif ($data['status'] < 2) {
                                    ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-light"> -- </span></h5>
                                        </td>
                                    <?php ;
                                    } else {
                                    ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-light">Selesai</span></h5>
                                        </td>

                                        <?php
                                    }

                                elseif (authHelpers::getRole() == 'finishing') :
                                    if ($data['status'] == 4) {
                                    ?>
                                        <td class="d-flextext-center">
                                            <button class="btn btn-primary btn-edit" id="btnProses" data-toggle="modal" data-target="#ModalProses" data-id_produksi="<?= $data[$dataColumn[0]]; ?>">
                                                <i class="fas fa-arrow-up"></i></button>
                                            <pre> </pre>
                                        </td>
                                    <?php ;
                                    } elseif ($data['status'] == 5) {
                                    ?>
                                        <td>
                                            <a href="<?= base_url(authHelpers::getRole() . "/edit//" . $data[$dataColumn[0]]); ?>" class="btn btn-success mr-1"><i class="fas fa-check"></i></a>
                                        </td>
                                    <?php ;
                                    } elseif ($data['status'] < 4) {
                                    ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-light"> -- </span></h5>
                                        </td>
                                    <?php ;
                                    } else {
                                    ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-light">Selesai</span></h5>
                                        </td>

                                            
                                <?php
                                    }
                                endif;
                            elseif (authHelpers::getRole() == 'manajer' and $menu == 'produksi') : ?>

                                <td class="d-flextext-center">
                                    <form action="<?= base_url(authHelpers::getRole() . "/delete"); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="<?= $dataColumn[0]; ?>" value="<?= $data[$dataColumn[0]]; ?>">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                            <?php
                            elseif ($menu !== 'barangmasuk' and $menu !== 'barangkeluar') : ?>

                                <td class="d-flextext-center">
                                    <a href="<?= base_url(authHelpers::getRole() . "/edit//" . $data[$dataColumn[0]]); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <form action="<?= base_url(authHelpers::getRole() . "/delete"); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="<?= $dataColumn[0]; ?>" value="<?= $data[$dataColumn[0]]; ?>">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                            <?php
                            endif; ?>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Manajer -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEditTitle">Update Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalDetails">
                <form method="POST" action="<?= base_url(authHelpers::getRole() . '/update'); ?>">
                    Tambah <b id="id"></b> ke data produksi ?
                    <hr>
                    <label class="form-label" for="estimasi">Estimasi :</label>
                    <input type="date" name="estimasi" class="form-control col-lg-6" value="<?= date('Y-m-d', strtotime('+' . (int)$estimasi . ' days', strtotime($dt))) ?>">
            </div>

            <div class="modal-footer">
                <input type="hidden" id="id_pesanan" name="id_pesanan">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-save">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Produksi -->
<div class="modal fade" id="ModalProses" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalProsesTitle">Proses Produksi ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalDetails">
                <form method="POST" action="<?= base_url(authHelpers::getRole() . '/update'); ?>">
                    Proses <b id="idProduksi"></b> ke tahap <?= authHelpers::getRole() ?> ?
            </div>

            <div class="modal-footer">
                <input type="hidden" id="id_produksi" name="id_produksi">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-save">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    /** After windod Load */
    $(window).bind("load", function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000);
    });

    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bifrtlp<"clear">',
            buttons: [{
                    extend: 'copyHtml5',
                    title: 'Laporan <?= $tableName; ?>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: 'Laporan <?= $tableName; ?>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Laporan <?= $tableName; ?>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    title: 'Laporan <?= $tableName; ?>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]
        });

        $('#dataTable tbody').on('click', '[id*=btnEdit]', function() {

            const id = $(this).data('id_pesanan');
            const bahan = $(this).data('id_bahan');
            var t = $('#dataTable').DataTable();
            $('#id').html(id);
            $('#id_pesanan').val(id);
            $('#modalEdit').show();
        });

        $('#dataTable tbody').on('click', '[id*=btnProses]', function() {
            const id = $(this).data('id_produksi');
            const bahan = $(this).data('id_bahan');
            var t = $('#dataTable').DataTable();
            $('#idProduksi').html(id);
            $('#id_produksi').val(id);
            $('#modalProses').show();
        });


    });
</script>

<?= $this->endSection() ?>