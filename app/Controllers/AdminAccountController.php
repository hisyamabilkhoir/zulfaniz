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
        helper("form");
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
        session();
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/admin_accounts_view_add', $data);
    }

    public function admin_accounts_add()
    {
        // dd($validasi);

        if (!$this->validate([
            'email'          => [
                'rules' => 'is_unique[administrators.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar !',
                ],
            ],
            'phone'          => [
                'rules' => 'is_unique[administrators.phone]',
                'errors' => [
                    'is_unique' => 'Nomor telepon sudah terdaftar !',
                ],
            ],
            'username'          => [
                'rules' => 'required|is_unique[administrators.username]',
                'errors' => [
                    'required' => 'Masukkan username terlebih dahulu',
                    'is_unique' => 'username sudah teregistrasi !',
                ],
            ],
            'password'      => [
                'rules' => 'min_length[3]',
                'errors' => [
                    'min_length' => 'Panjang password minimal 3 karakter !',
                ],
            ],
            'confirm_password'      => [
                'confpassword'  => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password salah !'
                ],
            ]
        ])) {
            $data = [
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/admin_accounts_view_add', $data);
        }

        $name = $this->request->getPost("name");
        $address = $this->request->getPost("address");
        $phone = $this->request->getPost("phone");
        $email = $this->request->getPost("email");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password") || null;

        $dataInsert = ([
            "name"                      => $name,
            "address"                   => $address,
            "phone"                     => $phone,
            "email"                     => $email,
            "username"                  => $username,
            "password"                  => password_hash($password, PASSWORD_BCRYPT),
            "active"                    => 1,
        ]);

        $this->adminModel->insert($dataInsert);

        $this->session->setFlashdata("msg_status", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Admin : $name berhasil ditambahkan !");
        return redirect()->to(base_url('eshop-admin/admin-accounts'));
    }
}
