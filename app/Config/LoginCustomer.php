<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class LoginCustomer extends BaseConfig
{
    private $customerModel;

    public $customerName = NULL;
    public $customerAddress = NULL;
    public $customerPhone = NULL;
    public $customerEmail = NULL;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->customerModel = new \App\Models\CustomerModel();

        if (session()->get('customer_id') != NULL) {
            $customer = $this->customerModel->where("id", session()->get('customer_id'))->first();

            $this->customerName = $customer->name;
            $this->customerEmail = $customer->email;
            $this->customerPhone = $customer->phone;
            $this->customerAddress = $customer->address;
            $this->customerImage = $customer->image;
        }
    }
}
