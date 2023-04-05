<?php

namespace App\Controllers;

use App\Database\Seeds\produksi;
use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;

class Manajer extends BaseController
{
    protected $session;
    protected $produkModel;
    protected $pesananModel;
    protected $produksiModel;
    public function __construct()
    {
        $this->session = session();
        $this->produkModel = new \App\Models\Bahan();
        $this->pesananModel = new \App\Models\Pesanan();
        $this->produksiModel = new \App\Models\Produksi();
    }

    public function index()
    {

        $pesanan =  $this->pesananModel->findAll();
        $dyeing = $this->produksiModel->where('status', '1')->findAll();
        $printing = $this->produksiModel->where('status', '3')->findAll();
        $finishing = $this->produksiModel->where('status', '5')->findAll();

        // Chart Dyeing
        $queryD = $this->produksiModel->joinChart('1', '2');
        $dataD['label'] = [];
        $dataD['data'] = [];
        foreach ($queryD as $q) {
            $qq = array_search($q['hari'], $dataD['label']);
            if ("" == $qq) {
                $dataD['label'][] = $q['hari'];
                $dataD['data'][] = $q['jumlah'];
            } else {
                $dataD['data'][$qq] += $q['jumlah'];
            };
        }
        $dataD['chart_data'] = json_encode($dataD);

        // Chart Printing
        $queryP = $this->produksiModel->joinChart('3', '4');

        $dataP['label'] = [];
        $dataP['data'] = [];
        foreach ($queryP as $q) {
            $qq = array_search($q['hari'], $dataP['label']);
            if ("" == $qq) {
                $dataP['label'][] = $q['hari'];
                $dataP['data'][] = $q['jumlah'];
            } else {
                $dataP['data'][$qq] += $q['jumlah'];
            };
        }
        $dataP['chart_data'] = json_encode($dataP);

        // Chart Finishing
        $queryF = $this->produksiModel->joinChart('5', '6');

        $dataF['label'] = [];
        $dataF['data'] = [];
        foreach ($queryF as $q) {
            $qq = array_search($q['hari'], $dataF['label']);
            if ("" == $qq) {
                $dataF['label'][] = $q['hari'];
                $dataF['data'][] = $q['jumlah'];
            } else {
                $dataF['data'][$qq] += $q['jumlah'];
            };
        }

        $dataF['chart_data'] = json_encode($dataF);


        $dataMonitoring = [
            [
                'card-color' => 'primary',
                'card-name' => 'Pesanan',
                'card-data' => count($pesanan),
                'card-icon' => 'Truck'
            ],
            [
                'card-color' => 'info',
                'card-name' => 'Dyeing',
                'card-data' =>  count($dyeing),
                'card-icon' => 'hand-paper'
            ],
            [
                'card-color' => 'success',
                'card-name' => 'Printing',
                'card-data' => count($printing),
                'card-icon' => 'print'
            ],
            [
                'card-color' => 'warning',
                'card-name' => 'Finishing',
                'card-data' => count($finishing),
                'card-icon' => 'warehouse'
            ],
        ];

        $dataChart = [
            [
                'chart-id' => '1',
                'chart-name' => 'Grafik Produksi Dyeing',
                'chart-desc' => 'Data Produksi Dyeing',
                'chart-data' => $dataD['chart_data']
            ],
            [
                'chart-id' => '2',
                'chart-name' => 'Grafik Produksi Printing',
                'chart-desc' => 'Data Produksi Printing',
                'chart-data' => $dataP['chart_data']

            ],
            [
                'chart-id' => '3',
                'chart-name' => 'Grafik Produksi Finishing',
                'chart-desc' => 'Data Produksi Finishing',
                'chart-data' => $dataF['chart_data']

            ],
        ];

        return view('dashboard', [
            'title' => 'Dashboard',
            'pageName' => 'Selamat Datang ' . authHelpers::getNama(),
            'menu' => 'main',
            'dataMonitoring' => $dataMonitoring,
            'dataChart' => $dataChart,
            'dataD' => $dataD,
            'dataP' => $dataP,
            'dataF' => $dataF
        ]);
    }


    //produksi
    public function produksi()
    {
        $tableName = 'Daftar Produksi';
        $tableHead = ['ID Produksi', 'Warna', 'Jenis', 'Jumlah', 'Nama Pemesan', 'Tanggal Pesan', 'Estimasi'];
        $bahan = $this->produksiModel->join();
        $pesanan = $this->produksiModel->joinS();
        $dataColumn = ['id_produksi', 'warna', 'jenis', 'jumlah', 'nama_pemesan', 'tgl_pesan', 'estimasi'];

        return view('manajer/manajemenproduk', [
            'title' => 'Kelola Produksi',
            'pageName' => 'Kelola Data Produksi',
            'menu' => 'produksi',
            'tambah' => '#',
            'tableName' => $tableName,
            'tableHead' => $tableHead,
            'tableData' => $bahan,
            'dataColumn' => $dataColumn,
            'pesanan' => $pesanan
        ]);
    }

    public function update()
    {
        $id_pesanan = $this->request->getPost('id_pesanan');
        $estimasi = $this->request->getPost('estimasi');
        $bahan = $this->pesananModel->find($id_pesanan);
        $data = [
            'id_produksi' => $bahan['id_bahan'] . $id_pesanan,
            'id_pesanan' => $id_pesanan,
            'id_bahan' => $bahan['id_bahan'],
            'estimasi' => $estimasi,
            'status' => '0',
        ];

        $this->produksiModel->insert($data);
        session()->setFlashdata('msg', 'Data Pesanan ' . $id_pesanan . ' Telah Masuk Antrian');
        session()->setFlashdata('class', 'alert alert-success');
        print_r($data);
        return redirect()->to(base_url(authHelpers::getRole() . "/produksi"));
    }


    public function destroy()
    {
        $id_produksi = $this->request->getPost('id_produksi');
        $this->produksiModel->delete($id_produksi);
        session()->setFlashdata('msg', 'Data ' . $id_produksi . ' Dihapus');
        session()->setFlashdata('class', 'alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/produksi"));
    }

    //Pesanan
    public function pesanan()
    {
        $tableName = 'Daftar Pesanan';
        $tableHead = ['ID Pesanan', 'Nama Pemesan', 'Alamat', 'Kontak', 'Warna', 'Jumlah', 'Tanggal Pesan'];
        $data = $this->pesananModel->joinProduk();
        $dataColumn = ['id_pesanan', 'nama_pemesan', 'alamat', 'kontak', 'warna', 'jumlah', 'tgl_pesan'];
        $pesanan = $this->produksiModel->joinS();

        return view('manajer/manajemenproduk', [
            'title' => 'Kelola Pesanan',
            'pageName' => 'Kelola Data Pesanan',
            'menu' => 'pesanan',
            'tambah' => '#',
            'tableName' => $tableName,
            'tableHead' => $tableHead,
            'tableData' => $data,
            'dataColumn' => $dataColumn,
            'pesanan' => $pesanan
        ]);
    }
}
