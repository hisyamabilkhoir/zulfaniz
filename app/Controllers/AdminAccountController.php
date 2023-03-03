<?php

namespace App\Controllers;

class AdminAccountController extends BaseController
{
    private $adminModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->validation =  \Config\Services::validation();
        $this->adminModel = new \App\Models\AdministratorModel();
    }

    public function admin_accounts()
    {
        $admin_accounts = $this->adminModel
            ->where("id !=", session()->get('admin_id'))
            ->orderBy("name", "asc")
            ->get()
            ->getResultObject();

        $data = ([
            "admin_accounts"       => $admin_accounts,
        ]);

        return view('admin/admin_accounts', $data);
    }

    public function admin_accounts_view_add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/admin_accounts_view_add', $data);
    }
}
