<?php

namespace App\Controllers;

use App\Helpers\authHelpers;

class AuthControllers extends BaseController
{
    protected $userModel;
    public $session;
    function  __construct()
    {
        $this->userModel = new \App\Models\Users();
        $this->session =  session();
    }

    public function index() //read
    {
        // 'Numquam ut mollitia at consequuntur inventore dolorem.'

        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        $result = $this->userModel->select('*')
            ->where('username =', $username)
            ->where('password =', $password)
            ->get()->getResult();
        if ($result) {
            $userdata = [
                'nama' => $result[0]->nama,
                'email' => $result[0]->email,
                'username' => $result[0]->username,
                'jabatan' => $result[0]->jabatan,
                'logged_in' => true,
            ];

            $this->session->set($userdata);

                // remember me
            if(!empty($this->request->getPost("remember"))) {
                setcookie ("loginId", $username, time()+ (10 * 365 * 24 * 60 * 60));  
                setcookie ("loginPass", $password,  time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                setcookie ("loginId",""); 
                setcookie ("loginPass","");
                }                    

            return redirect()->to(base_url('/' . authHelpers::getRole()));
        }
        session()->setFlashdata('err', 'Username or Password is incorrect.');
        return redirect()->to(base_url('/login' ));;
    }
    public function store() //update
    {
    }

    public function update() //edit
    {
    }

    public function delete() //delete
    {
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        authHelpers::logout();
        return redirect()->to(base_url('/login'));
    }
}
