<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function home()
    {
        // echo "test";
        return view('customer/home');
    }
}
