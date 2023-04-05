<?php

namespace App\Controllers;

use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;

class Dyeing extends BaseController
{
    protected $session;
    protected $userModel;
    protected $produksiModel;
    public function __construct()
    {
        $this->session = session();
        $this->userModel = new \App\Models\Users();
        $this->produksiModel = new \App\Models\Produksi();
        $this->pesananModel = new \App\Models\Pesanan();
    }

    public function index()
    {
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

        $dataChart = [
            [
                'chart-id' => '1',
                'chart-name' => 'Grafik Produksi Dyeing',
                'chart-desc' => 'Data Produksi Dyeing',
                'chart-data' => $dataD['chart_data']
            ]
        ];

        $dataMonitoring = [
            [
                'card-color' => 'primary',
                'card-name' => 'Pesanan',
                'card-data' =>  count($this->pesananModel->findAll()),
                'card-icon' => 'truck'
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

        return view('dashboard', [
            'title' => 'Dashboard',
            'pageName' => 'Selamat Datang ' . authHelpers::getNama(),
            'menu' => 'main',
            'dataMonitoring' => $dataMonitoring,
            'dataChart' => $dataChart
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

        return view('dyeing/manajemenproduk', [
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
        $id_produksi = $this->request->getPost('id_produksi');
        $data = [
            'status' => '1',
        ];

        $this->produksiModel->update($id_produksi, $data);
        session()->setFlashdata('msg', 'Data ' . $id_produksi . ' Telah Masuk Antrian ' . authHelpers::getRole());
        session()->setFlashdata('class', 'alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/produksi"));
    }
    public function edit($id)
    {
        $data = [
            'status' => '2',
        ];
        $this->produksiModel->update($id, $data);
        session()->setFlashdata('msg', 'Data ' . $id . ' Telah Selesai Proses ' . authHelpers::getRole());
        session()->setFlashdata('class', 'alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/produksi"));
    }
}
