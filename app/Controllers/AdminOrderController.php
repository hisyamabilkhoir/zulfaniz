<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;

class AdminOrderController extends BaseController
{
    private $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new \App\Models\InvoiceModel();
        helper("form");
    }

    public function admin_orders()
    {
        $data = [
            'invoices' => $this->invoiceModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_orders', $data);
    }
}
