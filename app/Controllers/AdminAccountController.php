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

    public function admin_accounts_view_edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'dataAccount' => $this->adminModel->where("id", $id)->first(),
        ];

        return view('admin/admin_accounts_view_edit', $data);
    }

    public function admin_accounts_update()
    {
        $id = $this->request->getPost('id');

        //cek data admin untuk validasi ubah
        $data_admin = $this->adminModel->where("id", $id)->first();

        if ($data_admin->username == $this->request->getPost('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[administrators.username]';
        }

        if ($data_admin->email == $this->request->getPost('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[administrators.email]';
        }

        if ($data_admin->phone == $this->request->getPost('phone')) {
            $rule_phone = 'required';
        } else {
            $rule_phone = 'required|is_unique[administrators.phone]';
        }

        if (!$this->validate([
            'username'          => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Masukkan username terlebih dahulu !',
                    'is_unique' => 'username sudah terdaftar !',
                ],
            ],
            'email'         => [
                'rules' => $rule_email,
                'errors' => [
                    'required' => 'Masukkan email terlebih dahulu !',
                    'is_unique' => 'Email sudah terdaftar !',
                ]
            ],
            'phone'         => [
                'rules' => $rule_phone,
                'errors' => [
                    'required' => 'Masukkan phone terlebih dahulu !',
                    'is_unique' => 'Nomor telepon sudah terdaftar !',
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/eshop-admin/admin-accounts/view-edit/' . $id))->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $address = $this->request->getPost("address");
        $username = $this->request->getPost("username");
        $status = $this->request->getPost("status");

        $this->adminModel->update($id, ([
            "name"                      => $name,
            "email"                      => $email,
            "phone"                      => $phone,
            "address"                      => $address,
            "username"                  => $username,
            "active"                    => $status,
        ]));

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Admin : $name berhasil disimpan !");
        return redirect()->to(base_url('eshop-admin/admin-accounts/view-edit/' . $id));
    }

    public function admin_accounts_reset_password()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password') || null;

        if (!$this->validate([
            'password'      => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Masukkan password terlebih dahulu',
                    'min_length' => 'Panjang password minimal 3 karakter !',
                ],
            ],
            'confirm_password'      => [
                'confpassword'  => 'matches[password]',
                'errors' => [
                    'matches' => 'konfirmasi password salah !'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('eshop-admin/admin-accounts/view-edit/' . $id . '/?active=password')->withInput()->with('validation', $validation);
        }

        $this->adminModel->update($id, ([
            "password"  => password_hash($password, PASSWORD_BCRYPT),
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Admin : <b>' . $name . '</b> berhasil reset password !');
        return redirect()->to(base_url('eshop-admin/admin-accounts/view-edit/' . $id . '/?active=password'));
    }
}
