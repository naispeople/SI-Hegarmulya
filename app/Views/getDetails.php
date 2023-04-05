
<?php
$name =$_GET['name'];

switch ($name) {
    case 'Dyeing':
        $q = '1';
        break;
    case 'Printing':
        $q = '3';
        break;
    case 'Finishing':
        $q = '5';
        break;
    default:
        break;
}


$produksiModel = new \App\Models\Produksi();
$data = $produksiModel->joinStatus($q);

if ($data) :
// echo '<div class="card-header py-3  d-flex align-middle justify-content-between align-items-center">';
// echo '<h6 class="m-0 font-weight-bold text-primary">';
// echo 'Produksi '.$name;
// echo '</h6>';
// echo '</div>';

echo '<div class="card-body">';
echo '<div class="table-responsive">';
echo "<table class='table table-bordered' width='100%'' cellspacing='0'>";
echo"<thead>
                 <tr>
                     <th>No.</th>
                     <th>ID Pesanan</th>
                     <th>Nama Pesanan</th>
                     <th>Alamat</th>
                     <th>Jenis</th>
                     <th>Jumlah</th>
                     <th>Tanggal Pesan</th>
                     <th>Estimasi</th>
                 </tr>
             </thead>
             <tbody>";
$i=1;
foreach ($data as $row) {
echo "<tr>";
echo "<td>".$i++."</td>";
echo"<td>" . $row['id_pesanan'] . "</td>";
echo"<td>" . $row['nama_pemesan'] . "</td>";
echo "<td>" . $row['alamat'] . "</td>";
echo "<td>" . $row['jenis'] . "</td>";
echo "<td>" . $row['jumlah'] . "</td>";
echo "<td>" . $row['tgl_pesan'] . "</td>";
echo "<td>" . $row['estimasi'] . "</td>";
echo "</tr></tbody>";
};
echo "</table>";
echo '</div">';
echo '</div">';

else :
    echo "Data Kosong";
endif;
?>
