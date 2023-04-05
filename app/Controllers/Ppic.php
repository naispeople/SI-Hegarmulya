<?php

namespace App\Controllers;

use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;

class Ppic extends BaseController
{
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
        $dyeing = $this->produksiModel->where('status', '1')->findAll();
        $printing = $this->produksiModel->where('status', '3')->findAll();
        $finishing = $this->produksiModel->where('status', '5')->findAll();

        // Chart Dyeing
        $queryD = $this->pesananModel->orderBy('tgl_pesan', 'ASC')->findAll();
        $dataD['label'] = [];
        $dataD['data'] = [];
        foreach ($queryD as $q) {
            $qq = array_search($q['tgl_pesan'], $dataD['label']);
            if ("" == $qq) {
                $dataD['label'][] = $q['tgl_pesan'];
                $dataD['data'][] = $q['jumlah'];
            } else {
                $dataD['data'][$qq] += $q['jumlah'];
            };
        }
        $dataD['chart_data'] = json_encode($dataD);

        $dataChart = [
            [
                'chart-id' => '1',
                'chart-name' => 'Grafik Pesanan',
                'chart-desc' => 'Data Pesanan',
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

    public function manajemenproduk()
    {
        $tableName = 'Daftar bahan';
        $tableHead = ['ID Bahan', 'Warna', 'Jenis', 'Stok'];
        $bahan = $this->produkModel->findAll();
        $dataColumn = ['id_bahan', 'warna', 'jenis', 'stok'];

        return view('ppic/manajemenproduk', [
            'title' => 'Kelola bahan',
            'pageName' => 'Kelola Data bahan',
            'menu' => 'manajemenproduk',
            'tambah' => 'tambahproduk',
            'tableName' => $tableName,
            'tableHead' => $tableHead,
            'tableData' => $bahan,
            'dataColumn' => $dataColumn
        ]);
    }
    public function add()
    {
        $data = $this->produkModel->getEnum();
        return view('ppic/tambahproduk', ['title' => 'Tambah bahan', 'pageName' => 'Form Tambah bahan', 'menu' => 'manajemenproduk', 'data' => $data]);
    }

    public function store()
    {
        $data = [
            'id_bahan' => $this->request->getPost('id_bahan'),
            'warna' => $this->request->getPost('warna'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
        ];
        $this->produkModel->insert($data);

        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenproduk"));
    }

    public function edit($id)
    {
        $bahan = $this->produkModel->find($id);
        $enum = $this->produkModel->getEnum();
        return view('ppic/editproduk', ['title' => 'Ubah Data bahan', 'pageName' => 'Form Edit bahan', 'menu' => 'manajemenproduk', 'data' => $bahan, 'enum' => $enum]);
    }
    public function update()
    {
        $data = [
            'warna' => $this->request->getPost('warna'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok')
        ];

        $this->produkModel->update($this->request->getPost('id_bahan'), $data);
        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenproduk"));
    }

    public function destroy()
    {
        $id_bahan = $this->request->getPost('id_bahan');
        $this->produkModel->delete($id_bahan);
        session()->setFlashdata('msg', 'Data ' . $id_bahan . ' Dihapus');
        session()->setFlashdata('class', 'alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenproduk"));
    }


    public function pesanan()
    {
        $tableName = 'Daftar Pesanan';
        $tableHead = ['ID Pesanan', 'Nama Pemesan', 'Alamat', 'Kontak', 'Warna', 'Jumlah', 'Tanggal Pesan'];
        $data = $this->pesananModel->joinProduk();
        $dataColumn = ['id_pesanan', 'nama_pemesan', 'alamat', 'kontak', 'warna', 'jumlah', 'tgl_pesan'];

        return view('ppic/manajemenproduk', [
            'title' => 'Kelola Pesanan',
            'pageName' => 'Kelola Data Pesanan',
            'menu' => 'pesanan',
            'tambah' => 'tambahpesanan',
            'tableName' => $tableName,
            'tableHead' => $tableHead,
            'tableData' => $data,
            'dataColumn' => $dataColumn
        ]);
    }

    public function add_pesanan()
    {
        $data = $this->produkModel->findAll();
        return view('ppic/tambahpesanan', ['title' => 'Tambah Pesanan', 'pageName' => 'Form Tambah Pesanan', 'menu' => 'pesanan', 'data' => $data]);
    }

    public function store_pesanan()
    {
        $data = [
            'id_pesanan' => $this->request->getPost('id_pesanan'),
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'id_bahan' => $this->request->getPost('id_bahan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tgl_pesan' => $this->request->getPost('tgl_pesan')
        ];
        $this->pesananModel->insert($data);

        return redirect()->to(base_url(authHelpers::getRole() . "/pesanan"));
    }

    public function edit_pesanan($id)
    {
        $data = $this->pesananModel->find($id);
        $bahan = $this->produkModel->findAll();
        return view('ppic/editpesanan', ['title' => 'Ubah Data Pesanan', 'pageName' => 'Form Edit Pesanan', 'menu' => 'pesanan', 'data' => $data, 'bahan' => $bahan]);
    }
    public function update_pesanan()
    {
        $data = [
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'id_bahan' => $this->request->getPost('id_bahan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tgl_pesan' => $this->request->getPost('tgl_pesan')
        ];

        $this->pesananModel->update($this->request->getPost('id_pesanan'), $data);
        return redirect()->to(base_url(authHelpers::getRole() . "/pesanan"));
    }

    public function destroy_pesanan()
    {
        $id_pesanan = $this->request->getPost('id_pesanan');
        $this->pesananModel->delete($id_pesanan);
        session()->setFlashdata('msg', 'Data ' . $id_pesanan . ' Dihapus');
        session()->setFlashdata('class', 'alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/pesanan"));
    }
}
