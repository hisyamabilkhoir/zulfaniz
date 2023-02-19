<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LogoutAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // jika admin sudah login
        if (session()->get('logged_in_admin')) {
            return redirect()->back();
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
