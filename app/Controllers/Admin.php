<?php

namespace App\Controllers;

use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;
use CodeIgniter\Exceptions\AlertError;

class Admin extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->session = session();
        $this->userModel = new \App\Models\Users();
    }

    public function index()
    {

        
        $dataMonitoring = [
            [
                'card-color' => 'primary',
                'card-name' => 'Admin',
                'card-data' => count($this->userModel->where('jabatan','admin')->findAll()),
                'card-icon' => 'user'
            ],
            [
                'card-color' => 'info',
                'card-name' => 'Dyeing',
                'card-data' => count($this->userModel->where('jabatan','dyeing')->findAll()),
                'card-icon' => 'user-alt'
            ],
            [
                'card-color' => 'success',
                'card-name' => 'Printing',
                'card-data' => count($this->userModel->where('jabatan','printing')->findAll()),
                'card-icon' => 'cash-register'
            ],
            [
                'card-color' => 'warning',
                'card-name' => 'Finishing',
                'card-data' => count($this->userModel->where('jabatan','finishing')->findAll()),
                'card-icon' => 'warehouse'
            ],
        ];

        return view('dashboard', [
            'title' => 'Dashboard',
            'pageName' => 'Selamat Datang ' . authHelpers::getNama(),
            'menu' => 'main',
            'dataMonitoring' => $dataMonitoring
        ]);
    }

    public function manajemenuser()
    {
        $tableName = 'Daftar Pengguna';
        $tableHead = ['id_user', 'Nama', 'Email', 'Username', 'Jabatan'];
        $user = $this->userModel->findAll();
        $dataColumn = ['id_user', 'nama', 'email', 'username', 'jabatan'];

        return view('admin/manajemenuser', [
            'title' => 'Kelola Pengguna',
            'pageName' => 'Kelola Data Pengguna',
            'menu' => 'manajemenuser',
            'tambah' => 'tambahuser',
            'tableName' => $tableName,
            'tableHead' => $tableHead,
            'tableData' => $user,
            'dataColumn' => $dataColumn
        ]);
    }

    public function add()
    {
        $role = $this->userModel->findColumn('jabatan');
        return view('admin/tambahuser', ['title' => 'Pembuatan Akun', 'pageName' => 'Form Pembuatan Akun', 'menu' => 'manajemenuser', 'data' => $role]);
    }

    public function store()
    {  
        $user = $this->request->getPost('username');
        $result = $this->userModel->where('username',$user)->find();
        if ($result) {
            session()->setFlashdata('msg','Username <b>"'. $this->request->getPost('username') . '"</b> Sudah digunakan !');
            session()->setFlashdata('class','alert alert-danger');
            return redirect()->to(base_url(authHelpers::getRole() . "/manajemenuser"));
        } else {

        $password = $this->request->getPost('password');
        $data = [
            'id_user' => utilityHelpers::UseridGenerator($this->request->getPost('jabatan')),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => md5($password),
            'jabatan' => $this->request->getPost('jabatan')
        ];
        $this->userModel->insert($data);

        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenuser"));
    }
    }

    public function edit($id_user)
    {
        $user = $this->userModel->find($id_user);
        return view('admin/edituser', ['title' => 'Ubah Data Akun', 'pageName' => 'Form Edit Akun', 'menu' => 'manajemenuser', 'data' => $user]);
    }
    public function update()
    {
        $password = $this->request->getPost('password');
        $data = [];
        if (!$password) {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'jabatan'     => $this->request->getPost('jabatan'),
            ];
        } else {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => md5($password),
                'jabatan'     => $this->request->getPost('jabatan'),
            ];
        }
        $this->userModel->update($this->request->getPost('id_user'), $data);
        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenuser"));
    }

    public function destroy()
    {
        $id_user = $this->request->getPost('id_user');
        $this->userModel->delete($id_user);
        session()->setFlashdata('msg', 'Data ' . $id_user . ' Dihapus');
        session()->setFlashdata('class','alert alert-success');
        return redirect()->to(base_url(authHelpers::getRole() . "/manajemenuser"));
    }
}
