<?php

namespace App\Filters;

use App\Helpers\authHelpers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class authFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!authHelpers::logged_in()) {
            return redirect()->to(base_url('/login'))->with('error', "Invalid Credential");
        }  
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
