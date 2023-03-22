<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;

class AdminOrderController extends BaseController
{
    private $invoiceModel;
    private $orderModel;

    public function __construct()
    {
        $this->invoiceModel = new \App\Models\InvoiceModel();
        $this->orderModel = new \App\Models\OrderModel();
        helper("form");
    }

    public function admin_orders()
    {
        $data = [
            'invoices' => $this->invoiceModel->orderBy('invoice', 'asc')->findAll(),
        ];
        return view('admin/admin_orders', $data);
    }
    public function admin_order($id)
    {
        $invoice = $this->invoiceModel->where('id', $id)->first();
        $productsId = $this->orderModel->where('invoice_id', $invoice->id)->findColumn('product_id');
        $products = $this->orderModel->where('invoice_id', $invoice->id)->whereIn('product_id', $productsId)->get()->getResultObject();
        $data = [
            'invoice' => $this->invoiceModel->where('id', $id)->orderBy('invoice', 'asc')->first(),
            'products' => $products,
        ];
        return view('admin/admin_order', $data);
    }
}
