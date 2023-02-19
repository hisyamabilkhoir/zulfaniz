<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Login extends BaseConfig
{
    private $session;
    private $adminModel;

    public $adminName = NULL;
    public $adminAddress = NULL;
    public $adminPhone = NULL;
    public $adminUsername = NULL;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->adminModel = new \App\Models\AdministratorModel();

        if (session()->get('admin_id') != NULL) {
            $admin = $this->adminModel->where("id", session()->get('admin_id'))->first();

            $this->adminName = $admin->name;
            $this->adminEmail = $admin->email;
            $this->adminPhone = $admin->phone;
            $this->adminAddress = $admin->address;
            $this->adminUsername = $admin->username;
        }
    }
}
