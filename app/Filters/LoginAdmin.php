<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // jika admin belum login
        if (session()->get('logged_in_admin') == null) {
            session()->setFlashdata('msg', 'Maaf, Silahkan login terlebih dahulu !');
            session()->setFlashdata('msg_status', 'danger');
            return redirect()->to(base_url('eshop-admin'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
