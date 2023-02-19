<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // echo "te";
        return redirect()->to(base_url('eshop-customer'));
    }
}
