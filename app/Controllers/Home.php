<?php

namespace App\Controllers;
use App\Helpers\authHelpers;

class Home extends BaseController
{
    public function index()
    {
        if (!authHelpers::logged_in()) {
            return redirect()->to(base_url('/login'));
        }else
        {
            return redirect()->to(base_url(authHelpers::getRole()));
    };
    }
}
